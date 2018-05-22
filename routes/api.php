<?php

use App\AlertFrequency;
use App\AlertMethod;
use App\AlertType;
use App\Http\Resources\AlertMethodCollection;
use App\Http\Resources\UserCollection;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\AlertTypeCollection;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\AlertFrequencyCollection;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 * Users
 */
//-- All
Route::get('/users', function() {
    return new UserCollection(User::all());
});

//-- Single
Route::group(['prefix' => 'user'], function() {
    Route::get('/{id}', function($id) {
        return User::with('profile')->find($id);
    });
});

/*
 * Alerts
 */
Route::group(['prefix' => 'alerts'], function() {
    Route::get('/frequency', function() {
        return new AlertFrequencyCollection(AlertFrequency::all());
    });
    Route::get('/types', function() {
        return new AlertTypeCollection(AlertType::all());
    });
    Route::get('/methods', function() {
        return new AlertMethodCollection(AlertMethod::all());
    });
});

/*
 * Services
 */
Route::group(['prefix' => 'services'], function() {
    Route::get('/all', function() {
        return new ServiceCollection(Service::all());
    });
//    Route::get('/frequency', function() {
//        return new AlertFrequencyCollection(AlertFrequency::all());
//    });
});
