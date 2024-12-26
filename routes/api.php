<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {

    Route::group(['namespace' => 'V1', 'prefix' => '/v1'], function () {
        
        Route::group(['namespace' => 'App', 'prefix' => '/app', 'middleware' => 'apiAuth'], function () {

            Route::get('/getIconsList', 'GetIconsList\IndexController');

            Route::group(['namespace' => 'CallRecording', 'prefix' => '/call-recording'], function () {
                Route::post('/', 'IndexController');
            });

            Route::group(['namespace' => 'OrderService', 'prefix' => '/order-services'], function () {
                Route::get('/{orderId}', 'IndexController');
                Route::post('/{orderId}', 'StoreController');
                Route::patch('/{orderId}/{serviceId}', 'UpdateController');
                Route::delete('/{orderId}/{serviceId}', 'DeleteController');
            });

            Route::group(['namespace' => 'OrderSparePart', 'prefix' => '/order-spare-parts'], function () {
                Route::get('/{orderId}', 'IndexController');
                Route::post('/{orderId}', 'StoreController');
                Route::patch('/{orderId}/{sparePartId}', 'UpdateController');
                Route::delete('/{orderId}/{sparePartId}', 'DeleteController');
            });

            Route::group(['namespace' => 'OrderMeta', 'prefix' => '/order-meta'], function () {
                Route::get('/{orderId}', 'IndexController');
                Route::patch('/{orderId}/{metaKey}', 'UpdateController');
                Route::delete('/{orderId}/{metaKey}', 'DeleteController');
            });

            Route::group(['namespace' => 'Setting', 'prefix' => '/setting'], function () {
                Route::patch('/', 'UpdateController');
            });

            Route::group(['namespace' => 'CheckConnection', 'prefix' => '/check-connection'], function () {
                Route::get('/', 'IndexController');
            });

            Route::group(['namespace' => 'Service', 'prefix' => '/service'], function () {
                Route::get('/', 'IndexController');
            });

            Route::group(['namespace' => 'SparePart', 'prefix' => '/spare-parts'], function () {
                Route::get('/', 'IndexController');
            });

        });

        Route::group(['namespace' => 'Request', 'middleware' => 'apiAuth'], function () {

            Route::post('/request', 'StoreController');

        });

        Route::group(['namespace' => 'Mango', 'prefix' => '/mango'], function () {

            Route::group(['namespace' => 'Events', 'prefix' => '/events'], function () {

                Route::post('/call', 'CallController');
                Route::post('/recording', 'RecordingController');
                Route::post('/summary', 'SummaryController');

            });

        });

    });

});
