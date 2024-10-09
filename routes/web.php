<?php

use App\Http\Controllers\Administrator;
use App\Http\Controllers\daftarBalitaController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\FoodRecallController;
use App\Http\Controllers\posyanduController;
use App\Http\Controllers\UsersList;
use App\Models\daftarBalita;
use App\Models\User;
use Illuminate\Http\Request;
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
        "daftarBalita" => $daftarBalita
    ]);
})->name("foodRecallCetak")->middleware("auth");
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
        Route::resource('posyandu', posyanduController::class);
        Route::get("logout", function (Request $request) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        })->name("logout");
    }
);
