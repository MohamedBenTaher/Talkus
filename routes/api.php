<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users/signup',[UserController::class,'Signup']);
Route::post('/users/login',[UserController::class,'Login']);
Route::get('/users/{id}',[UserController::class,'userProfile']);
Route::get('/departments',[DepartmentController::class,'index']);
Route::get('/posts',[PostController::class,'index']);
//Route::group(['prefix' => 'post'], function () {
 //   Route::post('add', 'PostController@add');
 //   Route::get('edit/{id}', 'PostController@edit');
 //   Route::post('update/{id}', 'PostController@update');
 //   Route::delete('delete/{id}', 'PostController@delete');
//});