<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource("message", "MessageController");
// We will handle create view and edit view by Angular
Route::resource("codefile", "CodeFileController", [
    'except' => 'create', 'edit'
]);
Route::resource("resourcefile", "ResourceFileController", [
    'except' => 'create', 'edit'
]);

Route::get("search/message", "MessageController@search");

