<?php

Route::group(['prefix' => config('adminamazing.path').'/balance', 'middleware' => ['web','CheckAccess']], function() {
	Route::get('/', 'Selfreliance\Balance\BalanceController@index')->name('AdminBalance');
	Route::get('/{id?}', 'Selfreliance\Balance\BalanceController@loadbalance')->name('AdminBalanceLoad');
});
