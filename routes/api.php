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
Route::group(['middleware' => ['client']], function () {
    
    Route::get('/healthprofessionalbridgeprocess/','API\HealthprofessionalbridgeprocessAPIController@index');
    Route::get('/healthprofessionalbridgeprocess/{idHealthProfessional}','API\HealthprofessionalbridgeprocessAPIController@getSystemProcessIdByIdHealthProfessional');
    Route::get('/healthprofessionalbridgeprocess/{idHealthProfessional}/{systemProcessId}','API\HealthprofessionalbridgeprocessAPIController@getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId');
    Route::get('/healthprofessionalbridgeprocess/healthProfessionals/{systemProcessId}','API\HealthprofessionalbridgeprocessAPIController@getIdHealthProfessionalBySystemProcessId');
    Route::post('/healthprofessionalbridgeprocess/','API\HealthprofessionalbridgeprocessAPIController@store');

    Route::get('/systemprocess/','API\SystemprocessAPIController@index');
    Route::get('/systemprocess/{externalProcessId}','API\SystemprocessAPIController@getSystemProcessByExternalProcessId');
    Route::post('/systemprocess','API\SystemprocessAPIController@store');

    Route::get('/processuser/','API\ProcessuserrelationAPIController@index');
    Route::get('/processuser/{idProcess}','API\ProcessuserrelationAPIController@getProcessUserInfoByIdProcess');
    Route::post('/processuser','API\ProcessuserrelationAPIController@store');
});



