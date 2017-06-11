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

Route::get('/todo', function () {
    return Todo::all();
})->middleware('api');

Route::get('/todo/{id}', function ($id) {
    $todo = Todo::find($id);
    return $todo;
})->middleware('api');

Route::post('/todo/create', function (Request $request) {
    $todo = ['content'=>$request['content'], 'completed'=>0];
    Todo::create($todo);
    return $todo;
})->middleware('api');

Route::patch('/todo/{id}/complete', function ($id) {
    $todo = Todo::find($id);
    $todo->completed = !$todo->completed;
    $todo->save();
    return $todo;
})->middleware('api');

Route::delete('/todo/{id}/delete', function ($id) {
    $todo = Todo::find($id);
    $todo->delete();
    return response()->json(['deleted']);
})->middleware('api');