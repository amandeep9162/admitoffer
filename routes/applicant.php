<?php

Route::group(['namespace' => 'Applicant'], function() {
    Route::get('/', 'HomeController@index')->name('applicant.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('applicant.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('applicant.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('applicant.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('applicant.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('applicant.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('applicant.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('applicant.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('applicant.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('applicant.verification.verify');


 

});