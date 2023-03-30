<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    return view('welcome');
});

//Test
Route::get('login', [App\Http\Controllers\Api\UsersController::class, 'index']);

Route::get('/showApiRegister', [App\Http\Controllers\Api\UsersController::class, 'showApiRegister']);
Route::get('/showLogin', [App\Http\Controllers\Api\UsersController::class, 'showLogin']);

Route::post('apiregister', [App\Http\Controllers\Api\UsersController::class, 'apiregister'])->name('reg');
Route::post('apilogin', [App\Http\Controllers\Api\UsersController::class, 'apilogin'])->name('log');


Route::get('/home', [App\Http\Controllers\Api\ControllerApi::class, 'home']);
Route::get('/welcome', [App\Http\Controllers\Api\ControllerApi::class, 'welcome']);

Route::get('/addlist', [App\Http\Controllers\Api\ControllerApi::class, 'addlist']);

Route::get('/additem2/{id}', [App\Http\Controllers\Api\ControllerApi::class, 'additem2']);
Route::get('/additem/{id}', [App\Http\Controllers\Api\ControllerApi::class, 'additem']);

//edit and delete
Route::get('/edititem/{id}', [App\Http\Controllers\Api\ItemController::class, 'editItems']);
Route::post('updateItem', [App\Http\Controllers\Api\ItemController::class, 'updateItem']);
Route::get('deleteitem/{id}', [App\Http\Controllers\Api\ItemController::class, 'deleteitem']);
Route::get('deleteList/{id}', [App\Http\Controllers\Api\ShoppingListController::class, 'deleteList']);

//sending data
Route::post('addAnItem', [App\Http\Controllers\Api\ItemController::class, 'addAnItem'])->name('sendItem');
Route::post('addList', [App\Http\Controllers\Api\ShoppingListController::class, 'addAList'])->name('sendList');

//fetching data
Route::get('/viewlist','App\Http\Controllers\Api\ShoppingListController@getList');

Route::get('viewitems/{id}', [App\Http\Controllers\Api\ItemController::class,'viewListItems']);

