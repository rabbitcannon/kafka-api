<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/throw', 'CriticalEventTestController@throwCriticalException');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');


/*
 * Auth required routing.
 */
Route::group(['middleware' => 'auth'], function() {

    /*
     * Profile routes
     */
    Route::group(['prefix' => '/profile'], function() {
        Route::get('/', 'ProfileController@view');
    });

    /*
     * Subscription CRUD operations
     */
    Route::group(['prefix' => '/subscriptions'], function() {
        Route::get('/create', 'SubscriptionController@create');
    });
});
