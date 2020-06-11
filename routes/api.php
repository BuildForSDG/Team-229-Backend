<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::post('refresh', 'DataCollectorController@refresh');
Route::post('me', 'DataCollectorController@me');
Route::post('login', 'DataCollectorController@login');
Route::get('user', 'DataCollectorController@getAuthUser');
Route::get('logout', 'DataCollectorController@logout');
Route::post('/register','DataCollectorController@register');
Route::get('/collectors','DataCollectorController@index');
Route::get('edit/{id}','DataCollectorController@editCollector');
Route::post('edit/{id}','DataCollectorController@updateCollector');
Route::delete('{id}','DataCollectorController@destroyCollector');

Route::post('/savesurvey','ParticipantController@storeResponse');
Route::get('/survey','ParticipantController@index');

Route::post('/addQuestion','QuestionController@store');
Route::get('/questions','QuestionController@index');
Route::get('view/{id}','QuestionController@check');
Route::post('update/{id}','QuestionController@updateQuestion');
Route::delete('question/{id}','QuestionController@destroyQuestion');
