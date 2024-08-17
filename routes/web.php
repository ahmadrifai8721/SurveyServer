<?php

use App\Http\Controllers\Administrator;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UsersList;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::get('/', [Dashboard::class, 'index'])->name('home');
Route::get('/SurveyList', [Dashboard::class, 'survey'])->name('survey');
Route::resource('/users', UsersList::class);
Route::prefix("/admin")->group(
    function () {
        Route::resource('server', Administrator::class)->names("Administrator");
    }
);
