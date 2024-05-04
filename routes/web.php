<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;


Route::get("/", function () {
   return view("welcome");
});

Route::middleware('guest')->group(function() {

Route::get('/register', [RegisterController::class, 'create'])->name("register.create");
Route::post('/register', [RegisterController::class, 'store'])->name("register.store");

Route::get('/login', [LoginController::class, 'loginForm'])->name("login.loginForm");
Route::post('/login', [LoginController::class, 'login'])->name("login");

});

Route::middleware("auth")->group(function () {

Route::get("/users", [UserController::class, 'showUserHeader'])->name("user.showUserHeader");
Route::get("/users/all", [UserController::class, 'index'])->name("user.users-list");
Route::get("/users/search", [UserController::class, 'search'])->name("user.search");
Route::get("/users/{User}/c", [ChatController::class, 'show'])->name("chat.show");
Route::post("/users/{User}/c", [ChatController::class, 'store'])->name("chat.store");
Route::get("/users/{chat}", [ChatController::class, 'retrieve'])->name("chat.retrieve");
Route::post("/logout", [LoginController::class, 'logout'])->name("logout");

});


