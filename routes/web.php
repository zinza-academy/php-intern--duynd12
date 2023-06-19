<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
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

Route::get('/',function(){
    return view('welcome');
});

Route::post("/login",[LoginController::class,"login"])->name("login");
Route::get("/logout",[LoginController::class,"logout"])->name("logout");

Route::middleware(['checkLoginUser'])->group(function(){   
    Route::get("/mail",[MailController::class,"index"])->name("mail.index");
    Route::post("/sendmail",[MailController::class,"senMail"])->name("mail.sendmail");
});



