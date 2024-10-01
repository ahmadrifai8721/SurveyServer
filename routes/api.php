<?php

use App\Models\daftarBalita;
use App\Models\foodRecall;
use App\Models\Respondent;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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
            return response()->json([daftarBalita::all()]);
        });
        route::post("/new", function (Request $request) {
            $data = $request->input();
            unset($data["uuid"]);
            $data["users_id"] = $request->uuid;
            $send = foodRecall::create($data);
            return response()->json([$send]);
        });
    }
);
