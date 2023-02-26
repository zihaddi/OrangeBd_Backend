<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/logout', [AuthController::class, 'logoutUser'])->middleware('auth:sanctum');

//Category
Route::get('/categories',[CategoryController::class,'view'])->middleware('auth:sanctum');
Route::post('/categoriesAdd', [CategoryController::class, 'postaddCategory']);
Route::post('/categoryEdit', [CategoryController::class, 'edit'])->name('categoryEdit');
Route::post('/categoriesEdit', [CategoryController::class, 'postedit']);

//Posts ::
Route::get('/posts',[PostController::class,'view'])->middleware('auth:sanctum');
Route::get('/postAdd', [PostController::class, 'add'])->name('postAdd');
Route::post('/postsAdd', [PostController::class, 'postadd']);
Route::post('/postEdit', [PostController::class, 'edit'])->name('postEdit');
Route::post('/postsEdit', [PostController::class, 'postedit']);
Route::post('/postDelete', [PostController::class, 'delete'])->name('postDelete');

Route::get('/users',[UserController::class,'view'])->middleware('auth:sanctum');
