<?php



Route::group(['prefix' => 'v1'], function(){
    /**
    * User Routes
    */
    Route::get('/user', 'API\UsersController@show');   
    Route::post('email/verify/{id}','API\EmailVerificationController@verify')->name('verificationapi.verify');
    Route::post('email/resend','API\EmailVerificationController@resend');

    Route::get('/materials', 'API\MaterialController@index');

    Route::post('/location', 'API\LocationController@store');
    Route::get('/location', 'API\LocationController@index');
    Route::get('/location/{id}', 'API\LocationController@show');
    Route::patch('/location/{id}', 'API\LocationController@update');
    Route::delete('/location/{id}', 'API\LocationController@destroy');
    
});