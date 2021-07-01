<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPage\ReadingRecordController;
use App\Http\Controllers\MyPage\BookManageController;
use App\Http\Controllers\MyPage\ProfileSettingsController;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPage\LaravelCollectiveTestController;
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
// Auth::routes();


// ---------------------------------
//*  読書記録APPトップページ      */
// ---------------------------------
Route::get('/', function () {
    return view('index');
    // return view('welcome');
});

// ---------------------------------
//*  認証                         */
// ---------------------------------

Auth::routes(['verify' => true]);
// ---------------------------------
//*  サービスページ               */
// ---------------------------------
// マイページトップ
Route::get('/mypage/home', [ReadingRecordController::class, 'index'])->name('mypage.home');
// プロフィール編集画面
Route::get('/mypage/profile/settings', [ProfileSettingsController::class, 'edit'])->name('mypage.profile.settings');
// プロフィールアップデート処理
Route::post('/mypage/profile/update/{id}', [ProfileSettingsController::class, 'update'])->name('mypage.profile.update');
// 書籍登録画面
Route::get('/mypage/book/register', [BookManageController::class, 'create'])->name('book_manage.create');
// 書籍登録処理
Route::post('/mypage/book/register', [BookManageController::class, 'store'])->name('book_manage.store');
// 登録書籍検索
Route::get('/mypage/book/title_search', [BookManageController::class, 'search'])->name('book_manage.title.search');
// 登録書籍詳細閲覧
Route::get('/mypage/book/detail/{id}', [BookManageController::class, 'detail'])->name('book_manage.detail');
// 登録書籍編集画面
Route::get('/mypage/book/edit/{id}', [BookManageController::class, 'edit'])->name('book_manage.edit');
// 登録書籍アップデート
Route::post('/mypage/book/update/{id}', [BookManageController::class, 'update'])->name('book_manage.update');
// 登録書籍削除
Route::post('/mypage/book/destroy/{id}', [BookManageController::class, 'destroy'])->name('book_manage.destroy');