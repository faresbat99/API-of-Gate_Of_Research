<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ResearchController;
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

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('reset',[PasswordController::class,'reset']);

Route::post('forgot',[PasswordController::class,'forgot']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user',[AuthController::class,'user']);
    Route::post('logout',[AuthController::class,'logout']);
});//before user is going to go here you make sure he is authenticated 👍 or not 👎
Route::post('addResearch',[ResearchController::class,'addResearch']);
Route::get('list',[ResearchController::class,'list']);
Route::delete('delete/{id}',[ResearchController::class,'delete']);
Route::get('product/{id}',[ResearchController::class,'getResearch']);
Route::put('update/{id}',[ResearchController::class,'updata']);
Route::get('search/{id}',[ResearchController::class,'search']);

// add research




