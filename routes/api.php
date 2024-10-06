<?php

use App\Models\daftarBalita;
use App\Models\foodRecall;
use App\Models\Respondent;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post(
    "/register",
    function (Request $request) {
        $send = Respondent::create($request->input());
        return response()->json([$send]);
    }
);
Route::post(
    "/login",
    function (Request $request) {
        $send = User::where([
            ["email", $request->email],
            ["password", $request->password]
        ])->first();
        return response()->json([$send]);
    }
);
Route::post(
    "/adminRegister",
    function (Request $request) {
        $validator = Validator::make($request->input(), [
            'name' => "required",
            "email" => 'required|email:rcf,dns|unique:users,email',
            "password" => 'required|min:8|max:16|alpha_num'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        } else {

            $data = $request->input();
            $data["uuid"] = Str::uuid();

            $add = User::create($data);
            if ($add) {
                return response()->json([$add], 200);
            } else {
                return response()->json(["AUTH" => "Gagal Registrasi"], 403);
            }
        }
    }
);
Route::post(
    "/isi/{respondent_id}",
    function (String $respondent_id, Request $request) {
        $dataPost = $request->all();
        $dataPost["respondent_id"] = $respondent_id;
        $send = Survey::create($dataPost);
        $send["status"] = true;
        return response()->json([$send]);
    }
);

Route::prefix("foodRecall")->middleware("foodRecallMW")->group(
    function () {

        route::get("/getBalita", function () {
            $send = [];
            $i = 1;
            foreach (daftarBalita::all() as $key => $value) {
                $send[$i++] = $value->namaBalita . "( $value->namaIbu )";
            }
            return response()->json([$send]);
        });
        route::post("/new", function (Request $request) {
            $data = $request->input();
            unset($data["uuid"]);
            $data["users_id"] = $request->uuid;
            $send = foodRecall::create($data);
            return response()->json([$send]);
        });
        route::get("/", function (Request $request) {

            return view("foodRecallAndro", [
                "pageTitle" => "Food Recal Report",
                "foodRecall" => foodRecall::all()
            ]);
        });
        route::get("/cetak{daftarBalita}", function (daftarBalita $daftarBalita, Request $request) {

            return view("foodRecallCetakAndro", [
                "pageTitle" => "Food Recal Report",
                "daftarBalita" => $daftarBalita
            ]);
        })->name("foodRecallCetakAndro");
    }
);
