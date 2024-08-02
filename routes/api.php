<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('getdepartment/{id}', 'app_materialAPIController@getdepartment');
Route::get('getsubject/{id}', 'app_materialAPIController@getsubject');
Route::resource('app_publishers', 'app_publisherAPIController');

Route::resource('subscriptions', 'SubscriptionAPIController');

Route::resource('subscription_plans', 'Subscription_planAPIController');

Route::resource('subscribers', 'SubscriberAPIController');

Route::resource('app_logos', 'app_logosAPIController');

Route::resource('external_apps', 'ExternalAppAPIController');

Route::resource('teacher_details', 'TeacherDetailAPIController');

Route::post('registrationtokenapi','UserRegsitrationAPIController@registrationapi');
