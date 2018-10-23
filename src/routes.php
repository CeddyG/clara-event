<?php

//Event
Route::group(['prefix' => config('clara.event.route.web.prefix'), 'middleware' => config('clara.event.route.web.middleware')], function()
{
    Route::resource('event', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventController', ['names' => 'admin.event']);
});

Route::group(['prefix' => config('clara.event.route.api.prefix'), 'middleware' => config('clara.event.route.api.middleware')], function()
{
    Route::get('event/index/ajax', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventController@indexAjax')->name('admin.event.index.ajax');
	Route::get('event/select/ajax', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventController@selectAjax')->name('admin.event.select.ajax');
});

//Category

Route::group(['prefix' => config('clara.event-category.route.api.prefix'), 'middleware' => config('clara.event-category.route.api.middleware')], function()
{
    Route::get('event-category/index/ajax', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventCategoryController@indexAjax')->name('admin.event-category.index.ajax');
	Route::get('event-category/select/ajax', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventCategoryController@selectAjax')->name('admin.event-category.select.ajax');
    Route::post('event-category/store/ajax', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventCategoryController@storeAjax')->name('admin.event-category.store.ajax');
    Route::delete('event-category/delete/ajax/{id}', 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventCategoryController@destroyAjax')->name('admin.event-category.delete.ajax');
});
