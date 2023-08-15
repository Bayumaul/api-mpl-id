<?php

use App\Http\Controllers\MatchScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function () {
    Route::get('/team/{team}', [TeamController::class, 'getTeamDetails']);
    Route::get('/teams', [TeamController::class, 'getTeams']);
    Route::get('/match-schedule', [MatchScheduleController::class, 'index']);
    Route::get('/match-schedule/{week}', [MatchScheduleController::class, 'getMatchesByWeek']);
});
