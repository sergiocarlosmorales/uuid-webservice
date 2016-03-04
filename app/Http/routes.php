<?php
Route::group(['middleware' => ['api']], function () {
    Route::get('1', 'Uuid_Version1Controller@get');
    Route::get('1/{whatever}', 'Uuid_Version1Controller@handleInvalidExtraParameters')->where(['whatever' => '.*']);

    Route::get('3', 'Uuid_Version3Controller@handleInsufficientParameters')->where(['whatever' => '.*']);
    Route::get('3/{nameSpace}/{value}', 'Uuid_Version3Controller@get');
    Route::get(
        '3/{nameSpace}/{value}/{whatever}',
        'Uuid_Version3Controller@handleInvalidExtraParameters'
    )->where(['whatever' => '.*']);
    Route::get('3/{whatever}', 'Uuid_Version3Controller@handleInsufficientParameters')->where(['whatever' => '.*']);

    Route::get('4', 'Uuid_Version4Controller@get');
    Route::get('4/{whatever}', 'Uuid_Version4Controller@handleInvalidExtraParameters')->where(['whatever' => '.*']);

    Route::get('5', 'Uuid_Version5Controller@handleInsufficientParameters')->where(['whatever' => '.*']);
    Route::get('5/{nameSpace}/{value}', 'Uuid_Version5Controller@get');
    Route::get(
        '5/{nameSpace}/{value}/{whatever}',
        'Uuid_Version5Controller@handleInvalidExtraParameters'
    )->where(['whatever' => '.*']);
    Route::get('5/{whatever}', 'Uuid_Version5Controller@handleInsufficientParameters')->where(['whatever' => '.*']);

    Route::get('', 'Uuid_Version5Controller@get');
});
