<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

