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

Route::get('/showRegister', [App\Http\Controllers\UsersController::class, 'showRegister']);
Route::get('/showLogin', [App\Http\Controllers\UsersController::class, 'showLogin']);

Route::get('/home', [App\Http\Controllers\Controller::class, 'home']);
Route::get('/welcome', [App\Http\Controllers\Controller::class, 'welcome']);

Route::get('/addlist', [App\Http\Controllers\Controller::class, 'addlist']);
//Route::get('/additem', [App\Http\Controllers\Controller::class, 'additem']);

Route::get('/additem2/{id}', [App\Http\Controllers\Controller::class, 'additem2']);
Route::get('/additem/{id}', [App\Http\Controllers\Controller::class, 'additem']);

//edit and delete
Route::get('/edititem/{id}', [App\Http\Controllers\ItemController::class, 'editItems']);
Route::post('updateItem', [App\Http\Controllers\ItemController::class, 'updateItem']);
Route::get('deleteitem/{id}', [App\Http\Controllers\ItemController::class, 'deleteitem']);
Route::get('deleteList/{id}', [App\Http\Controllers\ShoppingListController::class, 'deleteList']);

Route::post('apiregister', [App\Http\Controllers\UsersController::class, 'register'])->name('reg');
Route::post('apilogin', [App\Http\Controllers\UsersController::class, 'login'])->name('log');

//sending data
Route::post('addAnItem', [App\Http\Controllers\ItemController::class, 'addAnItem'])->name('sendItem');
Route::post('addList', [App\Http\Controllers\ShoppingListController::class, 'addAList'])->name('sendList');

//fetching data
Route::get('/viewlist','App\Http\Controllers\ShoppingListController@getList');
//Route::get('/viewitems','App\Http\Controllers\ItemController@getItems');

//Route::get('viewitems/{id}', [App\Http\Controllers\ShoppingListController::class,'viewListItems']);
Route::get('viewitems/{id}', [App\Http\Controllers\ItemController::class,'viewListItems']);

