<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Routing\Router;
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

Route::middleware(['checkLoginUser'])->group(function () {

    Route::get("/mail", [MailController::class, "index"])->name("mail.index");
    Route::post("/sendmail", [MailController::class, "sendMail"])->name("mail.sendmail");

    // user
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name("user.index");
        Route::get('/addUser', 'create')->name("user.create");
        Route::post('/addUser', 'store')->name("user.store");
        Route::get('/user/{id}', 'edit')->name("user.edit");
        Route::patch('/user/{id}', 'update')->name("user.update");
    });

    //setting 
    Route::controller(SettingController::class)->group(function () {
        Route::post('/setting', 'update')->name("setting.update");
        Route::get('/setting', 'index')->name("setting.store");
    });

    //dashboard

    Route::get('/', function () {
        return view('dashboard');
    });
});
//login , logout
Route::controller(LoginController::class)->group(function () {
    Route::get("/login", "index")->name("login.index");
    Route::post("/login", "login")->name("login");
    Route::get("/logout", "logout")->name("logout.logout");
});
