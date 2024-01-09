<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('candidates',[ApiController::class,'candidates']);
Route::post('employer_application','ApiController@employer_application');
Route::get('employer_application_list',[ApiController::class,'employer_application_list']);
Route::post('employer_application_delete','ApiController@employer_application_delete');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
