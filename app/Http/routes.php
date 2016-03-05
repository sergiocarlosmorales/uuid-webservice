<?php
Route::group(['middleware' => ['api']], function () {
    $wildCardRouteParameter = 'whatever';
    $wildCardRouteRegex = '.*';

    // UUIDv1.
    Route::get('1', 'Uuid_Version1Controller@get');
    Route::get(
        "1/{{$wildCardRouteParameter}}",
        'Uuid_Version1Controller@handleInvalidExtraParameters'
    )->where([$wildCardRouteParameter => $wildCardRouteRegex]);

    // UUIDv3.
    Route::get('3', 'Uuid_Version3Controller@handleInsufficientParameters');
    Route::get('3/{nameSpace}/{value}', 'Uuid_Version3Controller@get');
    Route::get(
        "3/{nameSpace}/{value}/{{$wildCardRouteParameter}}",
        'Uuid_Version3Controller@handleInvalidExtraParameters'
    )->where([$wildCardRouteParameter => $wildCardRouteRegex]);
    Route::get(
        "3/{{$wildCardRouteParameter}}",
        'Uuid_Version3Controller@handleInsufficientParameters'
    )->where([$wildCardRouteParameter => $wildCardRouteRegex]);

    // UUIDv4.
    Route::get('4', 'Uuid_Version4Controller@get');
    Route::get(
        "4/{{$wildCardRouteParameter}}",
        'Uuid_Version4Controller@handleInvalidExtraParameters'
    )->where([$wildCardRouteParameter => $wildCardRouteRegex]);

    // UUIDv5.
    Route::get('5', 'Uuid_Version5Controller@handleInsufficientParameters');
    Route::get('5/{nameSpace}/{value}', 'Uuid_Version5Controller@get');
    Route::get(
        "5/{nameSpace}/{value}/{{$wildCardRouteParameter}}",
        'Uuid_Version5Controller@handleInvalidExtraParameters'
    )->where([$wildCardRouteParameter => $wildCardRouteRegex]);
    Route::get(
        "5/{{$wildCardRouteParameter}}",
        'Uuid_Version5Controller@handleInsufficientParameters'
    )->where([$wildCardRouteParameter => $wildCardRouteRegex]);

    Route::get('', 'Uuid_Version5Controller@get');
});
