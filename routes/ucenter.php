<?php

use Illuminate\Support\Str;
use TopSystem\TopAdmin\Events\Routing;
use TopSystem\TopAdmin\Events\RoutingAdmin;
use TopSystem\TopAdmin\Events\RoutingAdminAfter;
use TopSystem\TopAdmin\Events\RoutingAfter;
use TopSystem\TopAdmin\Facades\Admin;

/*
|--------------------------------------------------------------------------
| UCenter Routes
|--------------------------------------------------------------------------
|
| This file is where you may override any of the routes that are included
| with Admin.
|
*/

Route::group(['as' => 'ucenter.'], function () {
    event(new Routing());

    $namespacePrefix = '\\'.config('ucenter.controllers.namespace').'\\';
//
//    Route::get('login', ['uses' => $namespacePrefix.'LoginController@login',     'as' => 'login']);
//    Route::post('login', ['uses' => $namespacePrefix.'LoginController@postLogin', 'as' => 'postlogin']);
//
//    Route::get('register', ['uses' => $namespacePrefix.'RegisterController@showRegistrationForm',     'as' => 'register']);
//    Route::post('register', ['uses' => $namespacePrefix.'RegisterController@register', 'as' => 'postregister']);
//    Route::get('payment/{gateway}', ['uses' => $namespacePrefix . 'PaymentController@gateway', 'as' => 'payment']);

    Route::group(['middleware' => 'admin.member'], function () use ($namespacePrefix) {
        event(new RoutingAdmin());

        // Main Admin and Logout Route
//        Route::get('/', ['uses' => $namespacePrefix . 'AdminController@index', 'as' => 'dashboard']);
//        Route::post('upload', ['uses' => $namespacePrefix . 'AdminController@upload', 'as' => 'upload']);
//
//        Route::get('profile', ['uses' => $namespacePrefix . 'AdminUserController@profile', 'as' => 'profile']);

//        Route::get('payment/{gateway}', ['uses' => $namespacePrefix . 'PaymentController@gateway', 'as' => 'payment']);
//        Route::any('pay_notice/{gateway}', ['uses' => $namespacePrefix . 'PaymentController@gatewayNotice', 'as' => 'payment.notice']);

    });

    event(new RoutingAfter());
});