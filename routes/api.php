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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['middleware'=>['api']],function(){
    Route::post('get-offices-from-hospital','ApiController@getOfficesFromHospital');
    Route::post('get-offices-from-hospitals','ApiController@getOfficesFromHospitals');
    Route::post('get-huifangs-from-customer','ApiController@getHuifangsFromCustomer');
    Route::post('get-huifangs-from-ghcustomer','ApiController@getHuifangsFromGhCustomer');
    Route::post('get-diseases-from-office','ApiController@getDiseasesFromOffice');
    Route::post('get-zxusers-from-office','ApiController@getZxUsersFromOffice');
    Route::post('get-jjusers-from-office','ApiController@getJjUsersFromOffice');
    Route::post('get-values-from-type','ApiController@getValuesFromType');

//    Route::get('dumphe359484408','ApiController@dumpHe359484408');

    Route::get('diseases','ApiController@getDisease');
    Route::get('gh','ApiController@guaHao');
    Route::get('gh.js','ApiController@guaHaoJs');
    Route::get('button-click','ApiController@saveClickCount');

});
