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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('{user}/{path}/gallery','GalleryController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('{user}', 'HomeController@view');
Route::resource('{user}/{path}/blog', 'BlogController');//  [
//    'names' => [
//        'create' => 'blogs.create',
//        'edit' => 'blogs.edit',
//        'show' => 'blogs.show',]
//    ]);#->middleware('auth');

Route::resource('/{user}/{path}/blog/{blog}/comments', 'CommentController');

Route::resource('{user}/pages','PageController');
Route::resource('{user}/{page_id}/coworker','CoworkerController');

