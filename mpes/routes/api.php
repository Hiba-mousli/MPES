<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Routing\Routes;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[UserController::class, 'Register']);
Route::post('/login',[UserController::class, 'Login']);
Route::get('/logout/{id}',[UserController::class, 'Logout']);
Route::post('/edit_user/{id}',[UserController::class, 'EditUser']);

Route::post('/update/{id}',[ProductController::class, 'Update']);
Route::post('/addproduct',[ProductController::class, 'addProduct']);
Route::get('/show details/{id}',[ProductController::class, 'ShowDetails']);
Route::get('/pagination',[ProductController::class, 'Pagination']);
Route::get('/user_product/{user_id}',[ProductController::class, 'UserProduct']);

Route::get('/getProducts', [ProductController::class, 'getProducts']);
Route::get('/searchByName/{product_name}', [ProductController::class, 'searchByName']);
Route::get('/searchByExpiry_date/{expiry_date}', [ProductController::class, 'searchByExpiry_date']);
Route::get('/sortingByType/{type}', [ProductController::class, 'sortingByType']);
Route::get('/showDetails/{id}', [ProductController::class, 'show']);//////dosent exisit
Route::post('/addLike/{id}', [ProductController::class, 'addLike']);
Route::get('/sortingByCategory/{category_id}', [ProductController::class, 'sortingByCategory']);
Route::get('/searchByType/{type}', [ProductController::class, 'searchByType']);
Route::delete('/destroy/{id}', [ProductController::class, 'destroy']);



Route::post('/addcomment',[CommentController::class, 'AddComment']);
Route::get('/view_comments/{Product_id}', [CommentController::class, 'ProductComments']);




