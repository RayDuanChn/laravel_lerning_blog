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

Route::get('/', function () {
    return view('welcome');
});

//文章列表
Route::get('/posts', 'PostController@index');

//添加文章
Route::get('/posts/create', 'PostController@create');
Route::post('/posts', 'PostController@store');

//编辑文章
Route::get('/posts/{post}/edit', 'PostController@edit');
Route::put('/posts/{post}', 'PostController@update');

//删除文章
Route::delete('/posts/{post}/delete', 'PostController@delete');

//文章详情
//默认情况： post => 表：posts => 主键：id
Route::get('/posts/{post}', 'PostController@show');





Route::get('/receipt', function () {

//    $pdf = App::make('dompdf.wrapper');
//    $pdf->loadHTML('<h1>Your HTML Here</h1>');
//    return $pdf->stream();

//    $pdf = PDF::loadView('receipt');
//    return $pdf->download('invoice.pdf');

    return PDF::loadFile(public_path() .'\receipt.php')->stream('download.pdf');


    //return view('receipt');
});

