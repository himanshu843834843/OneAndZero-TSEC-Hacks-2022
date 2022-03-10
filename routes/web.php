<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users',UsersController::class);
Route::post('users/getUsersJson',[UsersController::class, 'getUsersJson'])->name('users.getUsersJson');
Route::post('masters/users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
Route::post('masters/users/{user}/revoke-admin', [UsersController::class, 'revokeAdmin'])->name('users.revoke-admin');
