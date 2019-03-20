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

Route::get('acess/rhpr/{name?}', ['as' =>'api.opm','uses'=>'_Api\RHPR\OPMApiController@omsjd']);

Route::get('sjd/proc/adl/search/{id}', ['as' =>'api.adl','uses'=>'_Api\SJD\Proc\AdlApiController@find']);
Route::get('sjd/proc/adl/refano/{ref}/{ano}', ['as' =>'api.adlref','uses'=>'_Api\SJD\Proc\AdlApiController@refAno']);
Route::get('sjd/proc/adl/all', ['as' =>'api.adlall','uses'=>'_Api\SJD\Proc\AdlApiController@all']);
Route::get('sjd/proc/adl/ano/{ano}', ['as' =>'api.adlano','uses'=>'_Api\SJD\Proc\AdlApiController@ano']);
Route::get('sjd/proc/adl/andamento', ['as' =>'api.adland','uses'=>'_Api\SJD\Proc\AdlApiController@andamento']);
Route::get('sjd/proc/adl/andamentoano/{ano}', ['as' =>'api.adlandano','uses'=>'_Api\SJD\Proc\AdlApiController@andamentoAno']);
Route::get('sjd/proc/adl/prazos', ['as' =>'api.adlprazo','uses'=>'_Api\SJD\Proc\AdlApiController@prazos']);
Route::get('sjd/proc/adl/prazosano/{ano}', ['as' =>'api.adlprazoano','uses'=>'_Api\SJD\Proc\AdlApiController@prazosAno']);
Route::get('sjd/proc/adl/relsituacao', ['as' =>'api.adlrelsit','uses'=>'_Api\SJD\Proc\AdlApiController@relSituacao']);
Route::get('sjd/proc/adl/relsituacaoano/{ano}', ['as' =>'api.adlrelsituano','uses'=>'_Api\SJD\Proc\AdlApiController@relSituacaoAno']);
Route::get('sjd/proc/adl/julgamento', ['as' =>'api.adljulg','uses'=>'_Api\SJD\Proc\AdlApiController@julgamento']);
Route::get('sjd/proc/adl/julgamentoano/{ano}', ['as' =>'api.adljulgano','uses'=>'_Api\SJD\Proc\AdlApiController@julgamentoAno']);


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('its', 'ItAPIController');*/