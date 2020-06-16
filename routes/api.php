<?php

use Illuminate\Http\Request;

Route::post('login', 'DataCollectorController@login');
Route::post('/register','DataCollectorController@register');
Route::group(['middleware' => 'verifier'], function () {
    Route::post('refresh', 'DataCollectorController@refresh');
    Route::post('me', 'DataCollectorController@_me');
    Route::get('user', 'DataCollectorController@getAuthUser');
    Route::get('logout', 'DataCollectorController@logout');
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

});
