<?php

use App\Http\Controllers\Api\ProgressController;
use App\Http\Controllers\Api\UserController;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/unauthenticated',function(){
    return response()->json(["error" => "User not authenticated"], 401); 
})->name('login');


Route::get('/test',[ProgressController::class,'test']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/register',[UserController::class,'createUser']);
Route::post('/auth/login',[UserController::class,'loginUser']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/index',[ProgressController::class,'index']);
    
    Route::post('/auth/logout',[UserController::class,'logout']);
    Route::post('/add',[ProgressController::class,'store']);
    Route::patch('/update/{id}',[ProgressController::class,'update']);
    Route::delete('/delete/{id}',[ProgressController::class,'destroy']);
    Route::patch('/status/{id}',[ProgressController::class,'status']);
    Route::resource('progress',[ProgressController::class])->only();

});