<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

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


Route::get('/survey/{surveyId}/questions/{audienceType}', [SurveyController::class, 'getSurveyQuestions']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
