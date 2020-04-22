<?php

//Event
Route::group(['prefix' => config('clara.event.route.web.prefix'), 'middleware' => config('clara.event.route.web.middleware')], function()
{
    Route::get('event', config('clara.event.controller').'@index')->name('admin.event.index');
});

Route::group(['prefix' => config('clara.event.route.api.prefix'), 'middleware' => config('clara.event.route.api.middleware')], function()
{
	Route::apiResource('event', config('clara.event.controller'), ['names' => 'api.admin.event']);
});

//Category
Route::group(['prefix' => config('clara.event-category.route.api.prefix'), 'middleware' => config('clara.event-category.route.api.middleware')], function()
{
    Route::apiResource('event-category', config('clara.event-category.controller'), ['names' => 'api.admin.event-category']);
});
