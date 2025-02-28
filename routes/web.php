<?php

use App\Exports\foodrecallExport;
use App\Http\Controllers\Administrator;
use App\Http\Controllers\daftarBalitaController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\FoodRecallController;
use App\Http\Controllers\MateriAppController;
use App\Http\Controllers\posyanduController;
use App\Http\Controllers\UsersList;
use App\Models\daftarBalita;
use App\Models\foodRecall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get("/login", function () {
    return view("auth.login");
})->name("loginPage");
route::post("/login", function (Request $request) {

    $getuser = User::where([
        ["email", $request->email],
        ["password", $request->password]
    ])->first();
    if ($getuser) {
        # code...
        Auth::login($getuser, $request->remember);
        return redirect()->route("home");
    } else {
        return back()->withErrors(["User Tidak ditemukan"]);
    }
})->name("loginPagecheck");


Route::get('/', [Dashboard::class, 'index'])->name('home')->middleware("auth");
Route::get('/SurveyList', [Dashboard::class, 'survey'])->name('survey')->middleware("auth");
Route::resource('/respondent', UsersList::class)->middleware("auth");
Route::resource('/foodRecall', FoodRecallController::class)->middleware("auth");

Route::get('/foodRecallCetak{daftarBalita}', function (daftarBalita $daftarBalita) {

    return view("foodRecallCetak", [
        "pageTitle" => "Food Recal Report | $daftarBalita->namaBalita ( $daftarBalita->namaIbu )",
        "tanggal" => request()->input("tanggal") === null ? $daftarBalita->foodRecall->last()->tanggal : request()->input("tanggal"),
        "daftarBalita" => $daftarBalita
    ]);
})->name("foodRecallCetak")->middleware("auth");
Route::get("foodBulan", function () {

    $data = [];
    $bulan = Date("j");
    $tahun = Date("Y");

    foreach (foodRecall::all()->groupBy("daftar_balita_id") as $idBalita => $dataByBalita) {
        # code...
        foreach ($dataByBalita->groupBy("tanggal") as $tanggal => $dataByTanggal) {
            # code...
            if (strtotime($tanggal) >= strtotime("1-12-2024") && strtotime($tanggal) <= strtotime("31-12-2024")) {
                # code...
                foreach ($dataByTanggal->groupBy("waktu") as $key => $value) {
                    # code...
                    $data[daftarBalita::find($idBalita)->namaBalita][$tanggal][$key] = $dataByTanggal;
                }
            }
        }
    }
    // dump($data);
    // return $data;

    return view("foodRecallBulan", [
        "pageTitle" => "Food Recal Report Bulan $bulan tahun $tahun",
        "bulan" => $bulan,
        "tahun" => $tahun,
        "foodRecall" => daftarBalita::all()
    ]);
})->name("cetakBulan");
Route::get("foodBulan/{bulan}-{tahun}", function ($bulan, $tahun) {

    $data = [];

    foreach (foodRecall::all()->groupBy("daftar_balita_id") as $idBalita => $dataByBalita) {
        # code...
        foreach ($dataByBalita->groupBy("tanggal") as $tanggal => $dataByTanggal) {
            # code...
            if (strtotime($tanggal) >= strtotime("1-12-2024") && strtotime($tanggal) <= strtotime("31-12-2024")) {
                # code...
                foreach ($dataByTanggal->groupBy("waktu") as $key => $value) {
                    # code...
                    $data[daftarBalita::find($idBalita)->namaBalita][$tanggal][$key] = $dataByTanggal;
                }
            }
        }
    }
    // dump($data);
    // return $data;

    return view("foodRecallBulan", [
        "pageTitle" => "Food Recal Report Bulan $bulan tahun $tahun",
        "bulan" => $bulan,
        "tahun" => $tahun,
        "foodRecall" => daftarBalita::all()
    ]);
})->name("cetakBulanSet");
Route::post('/foodRecallGenerate', function (Request $request) {
    // dump($request->input('Tanggal'));
    $tanggal = $request->input('Tanggal');
    $foodRecall = foodRecall::where("created_at", 'like', "%" . $tanggal . "%")->get()->groupBy("created_at");
    $data = [];
    $i = 1;
    foreach ($foodRecall as $key => $value) {
        foreach ($value->groupBy("daftar_balita_id") as $key1 => $value1) {
            # code...
            $data[$key1] = $value1->first()->daftarBalita;
        }
    }
    // return $data;
    return view("layout.template-cetak", [
        "pageTitle" => "Food Recal Report Generate | " . Carbon::parse($tanggal)->isoFormat("DD MMMM YYYY"),
        "dataPerTanggal" => $data,
        "tanggal" => $tanggal
    ]);
})->name("foodRecallGenerate")->middleware("auth");
Route::resource('/daftarBalita', daftarBalitaController::class)->middleware("auth");
Route::post('/clearBalita', function () {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    daftarBalita::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    return back()->with("success", "Daftar Balita Berhasil di hapus");
})
    ->name("clearBalita")
    ->middleware("auth");
Route::prefix("/admin")->middleware("auth")->group(
    function () {
        Route::resource('server', Administrator::class)->names("Administrator");
        Route::get('foodRecallExport{tanggal}', function (string $date) {
            $date = date("Y-m-d", strtotime($date));
            // dd((new foodrecallExport)->tanggal($this->date)->download('foodrecall.xlsx'));
            return (new foodrecallExport)->tanggal($date)->download("foodrecall-$date.xlsx");
        })->name("foodRecallExport");
        Route::resource('posyandu', posyanduController::class);
        Route::get("logout", function (Request $request) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        })->name("logout");

        Route::prefix("app")->group(function () {
            Route::resource('materi', MateriAppController::class);
        });
    }
);
