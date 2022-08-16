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

use Illuminate\Http\Request;
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
/* Route::get('/home', 'HomeController@index')->name('home'); */
Route::get('/todo', function () {
    return view('todo');
});
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
    $data = Session::all();
    $folders[]['folder_name'] = 'none';
    Log::debug($data, ['file' => __FILE__, 'line' => __LINE__]);
    return view('storage')->with([
        'folders' => json_encode($folders),
    ]);
});


Route::prefix('/api')->group(function () {
    Route::post('/uploadtobox', 'StudyController@upload_box');
    Route::post('/fileupload', 'PhotoAlbumController@store');
    Route::get('/uploadfrombox', 'PhotoAlbumController@boxindex');

    Route::get('/items', 'ItemController@index');
    Route::prefix('/item')->group(function () {
        route::post('/store', 'ItemController@store');
        route::put('/{id}', 'ItemController@update');
        route::delete('/{id}', 'ItemController@destroy');
    });

    Route::get('photo', 'PhotoAlbumController@index');
    Route::prefix('/photo')->group(function () {
        route::get('/detail/{id}', 'PhotoAlbumController@show');
        route::get('/title/{id}', 'PhotoAlbumController@title_show');
        route::post('/{id}', 'PhotoAlbumController@update');
    });
    Route::post('/getpreview', 'StorageController@getpreview');
    Route::get('/news', 'NewsController@news_list');
    Route::post('/news/store', 'NewsController@store');
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
