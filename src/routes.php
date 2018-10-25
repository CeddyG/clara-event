<?php

//Event
Route::group(['prefix' => config('clara.event.route.web.prefix'), 'middleware' => config('clara.event.route.web.middleware')], function()
{
    Route::resource('event', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventController', ['names' => 'admin.event']);
});

Route::group(['prefix' => config('clara.event.route.api.prefix'), 'middleware' => config('clara.event.route.api.middleware')], function()
{
	Route::apiResource('event', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventController', ['names' => 'api.admin.event']);
});

//Category
Route::group(['prefix' => config('clara.event-category.route.api.prefix'), 'middleware' => config('clara.event-category.route.api.middleware')], function()
{
    Route::apiResource('event-category', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventCategoryController', ['names' => 'api.admin.event-category']);
});
