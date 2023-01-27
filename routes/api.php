<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InputedStringsController;

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

Route::apiResources([
    'inputed-strings' => InputedStringsController::class
]);

Route::delete('destroy-all', [InputedStringsController::class, 'destroyAll']);

Route::get('last-strings', [InputedStringsController::class, 'lastStrings']);

Route::get('show-last', [InputedStringsController::class, 'showLast']);

Route::post('auto-check/{str}', [InputedStringsController::class, 'autoCheck']);