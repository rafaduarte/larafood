<?php

Route::prefix('admin')
        ->namespace('Admin')
        ->group(function() {

    /**
     * Route Details Plans
     */
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');


    /**
     * Routes Plans
     */
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}','PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');

    Route::get('admin', 'PlanController@index')->name('admin.index');
});
/*
Route::get('admin/plans/create', 'Admin\PlanController@create')->name('plans.create');
Route::put('admin/plans/{url}', 'Admin\PlanController@update')->name('plans.update');
Route::get('admin/plans/{url}/edit', 'Admin\PlanController@edit')->name('plans.edit');
Route::any('admin/plans/search', 'Admin\PlanController@search')->name('plans.search');
Route::delete('admin/plans/{url}','Admin\PlanController@destroy')->name('plans.destroy');
Route::get('admin/plans/{url}', 'Admin\PlanController@show')->name('plans.show');
Route::post('admin/plans', 'Admin\PlanController@store')->name('plans.store');
Route::get('admin/plans', 'Admin\PlanController@index')->name('plans.index');
Route::get('admin', 'Admin\PlanController@index')->name('admin.index');
*/

Route::get('/', function () {
    return view('welcome');
});
