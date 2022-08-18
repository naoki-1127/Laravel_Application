<?php

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

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

/* Auth::routes(); */

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::middleware(['samlauth'])->group(function () {
    Route::get('/home', 'HomeController@index');
});

Route::middleware(['session'])->group(function () {
    Route::get('/todo', 'ItemController@index');
    Route::get('/photo', function () {
        return view('photo');
    });
    Route::get('/study', function () {
        return view('study');
    });
    Route::get('/dictionary', function () {
        return view('dictionary');
    });
    Route::get('/news', 'NewsController@index');
    Route::get('/storageapi', function () {
        $folders[]['folder_name'] = 'none';
        return view('storage')->with([
            'folders' => json_encode($folders),
        ]);
    });
});

Route::prefix('/api')->group(function () {
    Route::post('/uploadtobox', 'StudyController@upload_box');
    Route::post('/fileupload', 'PhotoAlbumController@store');
    Route::get('/uploadfrombox', 'PhotoAlbumController@boxindex');
    Route::post('/getpreview', 'StorageController@getpreview');

    
    Route::prefix('/item')->group(function () {
        Route::get('/', 'ItemController@itemlist');
        route::post('/store', 'ItemController@store');
        route::put('/{id}', 'ItemController@update');
        route::delete('/{id}', 'ItemController@destroy');
    });
    
    Route::prefix('/photo')->group(function () {
        Route::get('/', 'PhotoAlbumController@index');
        route::get('/detail/{id}', 'PhotoAlbumController@show');
        route::get('/title/{id}', 'PhotoAlbumController@title_show');
        route::post('/{id}', 'PhotoAlbumController@update');
    });
    
    Route::prefix('/news')->group(function () {
        Route::get('/', 'NewsController@news_list');
        Route::post('/store', 'NewsController@store');
        Route::get('/stock', 'NewsController@stock_news_list');
        Route::delete('/{id}', 'NewsController@destroy');
    });
});

Route::get('/box/redirect', 'StorageController@boxredirect')->name('box_redirect');
Route::get('/callback', 'StorageController@boxcallback');

Route::get('/a', function () {
    //return dd(\Config::get('mail'));
    
    $data = ['name' => 'taro']; //メールテンプレートに渡す変数データ
    Mail::send('emails.hello', $data, function ($message) {
        $message->from('yamamoto03031127@gmail.com', '山本尚輝') // 偽装でも送信可だが迷惑メール行き！
                ->to('lillardtime1127@icloud.com', '山本尚輝')
                ->subject('test_subject')
//              ->attach('http://k.yimg.jp/images/top/sp2/cmn/logo-ns-131205.png') // 添付ファイルは、パスやURLを指定する
//              ->attachData("this is text", 'a.txt') // 変数データ＆ファイル名でもOK
                ;
    });
    return "メール送信完了！";
});
