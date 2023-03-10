<?php

use App\Http\Controllers\Api\NewsContriller;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
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

Route::get("/users", [UserController::class, "getUsers"]);
Route::get("/news", [NewsContriller::class, "GetNews"]);
Route::post("/addnews", [NewsContriller::class, "Addnews"]);

Route::delete("/news-delete/{id}", [NewsContriller::class, "delete"]);
Route::get("/news/{id}", [NewsContriller::class, "getNewsById"]);
Route::post("/news-update", [NewsContriller::class, "update"]);
