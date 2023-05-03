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

Route::get('/')->name('home')->uses('HomeController');

Route::post('/media/upload')->name('media.upload')->uses('MediaController@store');

Route::group([
    'prefix' => 'article',
    'as' => 'article.',
    'namespace' => 'Article'
], function () {
    Route::middleware('auth')
        ->group(function () {
            Route::get('create')->name('create')->uses('CreateController@showForm');
            Route::post('store')->name('store')->uses('CreateController@store');
        });
    Route::get('{article}')->name('show')->uses('ShowController'); // FIXME: Authミドルウェアグループの上に置きたいけど何故か認識されない
});

Route::prefix('my_page')
    ->as('my_page.')
    ->namespace('MyPage')
    ->group(function(){
        Route::prefix('user')
            ->as('user.')
            ->group(function () {
                Route::get('edit')->name('edit')->uses('UserController@edit');
                Route::post('edit')->name('update')->uses('UserController@update');
            });
    });

Route::namespace('Auth')
    ->group(function () {
        Route::get('/login')->name('login')->uses('LoginController@showLoginForm')->name('home');
        Route::post('/login')->name('login')->uses('LoginController@login');

        Route::get('/logout')->name('logout')->uses('LoginController@logout');
        Route::get('password/confirm')->name('password.confirm')->uses('ConfirmPasswordController@showConfirmForm');
        Route::post('password/confirm')->name('password.confirm')->uses('ConfirmPasswordController@confirm');
        Route::post('password/email')->name('password.email')->uses('ForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset')->name('password.request')->uses('ForgotPasswordController@showLinkRequestForm');
        Route::post('password/reset')->name('password.update')->uses('ForgotPasswordController@reset');
        Route::get('password/reset/{token}')->name('password.reset')->uses('ResetPasswordController@showResetForm');
        Route::get('register')->name('register')->uses('RegisterController@showRegistrationForm');
        Route::post('register')->name('register')->uses('RegisterController@register');

        Route::prefix('email')
            ->as('verification.')
            ->group(function () {
                Route::post('resend')->name('resend')->uses('VerificationController@resend');
                Route::get('verify')->name('notice')->uses('VerificationController@show');
                Route::get('verify/{id}/{hash}')->name('verify')->uses('VerificationController@verify');
                Route::get('verified')->name('verified')->uses('VerificationController@verified');
            });
    });

Route::prefix('sample')
    ->as('sample.')
    ->group(function () {
        Route::get('class')->name('class')->uses('SampleController@class');
        Route::get('reverseClass')->name('reverseClass')->uses('SampleController@reverseClass');
    });
