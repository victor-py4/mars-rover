<?php

use App\Http\Controllers\Planet\PlanetController;
use App\Http\Controllers\Rover\RoverController;
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

//Rover
Route::prefix('rover')->group(function () {
    Route::get('/{id}', [RoverController::class, 'getRover'])->name('rover.get');
    Route::get('name/{name}', [RoverController::class, 'getRoverByName'])->name('rover.get-by-name');
    Route::put('update', [RoverController::class, 'updateRover'])->name('rover.update');
    Route::post('send-instructions', [RoverController::class, 'sendInstructions'])->name('rover.send-instructions');
    Route::delete('delete', [RoverController::class, 'deleteRover'])->name('rover.delete');
});

Route::prefix('planet')->group(function () {
    Route::get('/{id}', [PlanetController::class, 'getPlanet'])->name('planet.get');
    Route::post('get-bounding-box', [PlanetController::class, 'getPlanetBoundingBox'])->name('planet.get-bounding-box');
    Route::put('update', [PlanetController::class, 'updatePlanet'])->name('planet.update');
    Route::delete('delete', [PlanetController::class, 'deletePlanet'])->name('planet.delete');
});
