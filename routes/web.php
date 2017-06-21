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


Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'admin'], function () {

        Route::get('/', 'EmployeeController@index');

        Route::group(['prefix' => 'employee'], function () {
        Route::get('/', 'EmployeeController@index');
        Route::get('create', 'EmployeeController@create');
        Route::post('/', 'EmployeeController@store');
        Route::get('{id}/edit', 'EmployeeController@edit');
        Route::delete('{id}', 'EmployeeController@destroy');});


         Route::group(['prefix' => 'service'], function () {
         Route::get('/', 'ServiceController@index');
         Route::get('create', 'ServiceController@create');
         Route::post('/', 'ServiceController@store');
         Route::get('{id}/edit', 'ServiceController@edit');
         Route::delete('{id}', 'ServiceController@destroy');  });

            Route::group(['prefix' => 'blog'], function () {
            Route::get('/', 'BlogController@index');
            Route::get('create', 'BlogController@create');
            Route::post('/', 'BlogController@store');
            Route::get('category', 'BlogController@sendChildCategory');
            Route::get('{id}/edit', 'BlogController@edit');
            Route::delete('{id}', 'BlogController@destroy');  });

        Route::group(['prefix' => 'ourwork'], function () {
        Route::get('/', 'OurWorkController@index');
        Route::get('create', 'OurWorkController@create');
        Route::post('/', 'OurWorkController@store');
        Route::get('{id}/edit', 'OurWorkController@edit');
        Route::delete('{id}', 'OurWorkController@destroy');  });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index');
        Route::get('create', 'CategoryController@create');
        Route::post('/', 'CategoryController@store');
        Route::get('{id}/edit', 'CategoryController@edit');
        Route::delete('{id}', 'CategoryController@destroy');  });

    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', 'SubCategoryController@index');
        Route::get('create', 'SubCategoryController@create');
        Route::post('/', 'SubCategoryController@store');
        Route::get('{id}/edit', 'SubCategoryController@edit');
        Route::delete('{id}', 'SubCategoryController@destroy');  });

});