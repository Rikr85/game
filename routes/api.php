<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*
Route::prefix('v1')->group(function(){
    Route::apiResource('/game', GameController::class);
});
*/
Route::apiResource('/game', GameController::class);