<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPage\HomeController;
use App\Http\Controllers\MyPage\BookRegisterController;
// use App\Http\Controllers\HomeController;
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mypage/home', [HomeController::class, 'index'])->name('mypage.home');
Route::get('/mypage/book/register', [BookRegisterController::class, 'index'])->name('mypage.register');
// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// Route::group(['prefix' => 'userpage', 'middleware' => 'auth:admin'], function () {
//     Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
//     Route::get('home',      'Admin\HomeController@index')->name('admin.home');
// });