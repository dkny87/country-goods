<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login');
});

Route::group(['middleware' => 'session'], function () {
    Route::post('auth/logout', 'Auth\LoginController@logout');
    Route::namespace('API')->group(function () {
        Route::namespace('Categories')->group(function () {
            Route::apiResource('categories', 'CategoryController');
        });

        Route::namespace('Products')->group(function () {
            Route::apiResource('products', 'ProductController');
        });

        Route::namespace('Customers')->group(function () {
            Route::apiResource('customers', 'CustomerController');
        });

        Route::namespace('Employees')->group(function () {
            Route::apiResource('employees', 'EmployeeController');
        });
    });
});

