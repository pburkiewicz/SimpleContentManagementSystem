<?php
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

Route::get('/{user}', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('gallery','GalleryController');

Route::get('/{user}.home', 'HomeController@index')->name('home');
Route::resource('/blogs', 'BlogController');//  [
//    'names' => [
//        'create' => 'blogs.create',
//        'edit' => 'blogs.edit',
//        'show' => 'blogs.show',]
//    ]);#->middleware('auth');

Route::resource('/blogs/{blog}/comments', 'CommentController');


