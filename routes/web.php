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
     * User operations
     */
    Route::group(['prefix' => '/user'], function() {
        Route::put('/{id}/edit', 'UserController@edit');
    });

    /*
     * Subscription CRUD operations
     */
    Route::group(['prefix' => '/subscriptions'], function() {
        Route::get('/', function() {
            return view('subscriptions.index');
        });

        Route::get('/single/{id}', 'SubscriptionController@getSubscription');
        Route::get('/list', 'SubscriptionController@listSubscriptions');
        Route::put('/edit/{id}', 'SubscriptionController@edit');
        Route::post('/create', 'SubscriptionController@create');
        Route::post('/delete/{id}', 'SubscriptionController@delete');
    });
});
