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

//route 中间件
Route::get('/', function () {
    //
})->middleware('first', 'second');


//中間件组
Route::get('admin/profile', ['middleware' => 'auth', function()
{
    //当我们访问http://yourdomain/admin/profile的时候，
    //首先会经过全局中间件，然后就是我们在app/Http/Kernel.php的$routeMiddleware数组中定义的名称为auth的中间件

    Route::get('user', function() {
        // blablabla...
    });
    Route::get('article', function() {
        // blablabla...
    });
}]);




Route::get('/receipt', function () {

//    $pdf = App::make('dompdf.wrapper');
//    $pdf->loadHTML('<h1>Your HTML Here</h1>');
//    return $pdf->stream();

//    $pdf = PDF::loadView('receipt');
//    return $pdf->download('invoice.pdf');

    return PDF::loadFile(public_path() .'\receipt.php')->stream('download.pdf');


    //return view('receipt');
});

