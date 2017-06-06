<?php

use Illuminate\Http\Request;
use App\Model\Todo;

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

Route::get('/todo', function (){
    return Todo::all();
})->middleware('api');

Route::get('/todo/{id}', function($id){
    $todo = Todo::find($id);
    return $todo;
})->middleware('api');