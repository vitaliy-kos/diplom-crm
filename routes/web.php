<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Crm', 'as' => 'crm.', 'middleware' => ['auth']], function () {

        Route::get('/', 'IndexController')->name('index');

        Route::group(['namespace' => 'Setting', 'as' => 'setting.', 'prefix' => 'settings'], function () {
            Route::get('/', 'IndexController')->name('index');
        });

        Route::group(['namespace' => 'Order', 'as' => 'order.', 'prefix' => 'orders'], function () {
            Route::get('/filter/{filter?}', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{order}', 'ShowController')->name('show');
            Route::get('/{order}/edit', 'EditController')->name('edit');
            Route::patch('/{order}', 'UpdateController')->name('update');
            Route::get('/{order}/status/{statusId}', 'StatusController')->name('status');
        });

        Route::group(['namespace' => 'ClientRequest', 'as' => 'clientRequest.', 'prefix' => 'client-requests', 'middleware' => ['admin']], function () {
            Route::get('/filter/{filter?}', 'IndexController')->name('index');
            Route::get('/{clientRequest}', 'ShowController')->name('show');
        });

        Route::group(['namespace' => 'User', 'as' => 'user.', 'prefix' => 'users', 'middleware' => ['admin']], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{user}', 'ShowController')->name('show');
            Route::get('/{user}/edit', 'EditController')->name('edit');
            Route::patch('/{user}', 'UpdateController')->name('update');
            Route::delete('/{user}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'City', 'as' => 'city.', 'prefix' => 'cities'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{city}', 'ShowController')->name('show');
            Route::get('/{city}/edit', 'EditController')->name('edit');
            Route::patch('/{city}', 'UpdateController')->name('update');
            Route::delete('/{city}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'MetroStation', 'as' => 'metroStation.', 'prefix' => 'metroStations'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{metroStation}', 'ShowController')->name('show');
            Route::get('/{metroStation}/edit', 'EditController')->name('edit');
            Route::patch('/{metroStation}', 'UpdateController')->name('update');
            Route::delete('/{metroStation}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Service', 'as' => 'service.', 'prefix' => 'services'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{service}', 'ShowController')->name('show');
            Route::get('/{service}/edit', 'EditController')->name('edit');
            Route::patch('/{service}', 'UpdateController')->name('update');
            Route::delete('/{service}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Status', 'as' => 'status.', 'prefix' => 'statuses'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{status}', 'ShowController')->name('show');
            Route::get('/{status}/edit', 'EditController')->name('edit');
            Route::patch('/{status}', 'UpdateController')->name('update');
            Route::delete('/{status}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'ExpenseType', 'as' => 'expenseType.', 'prefix' => 'expenseTypes'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{expenseType}', 'ShowController')->name('show');
            Route::get('/{expenseType}/edit', 'EditController')->name('edit');
            Route::patch('/{expenseType}', 'UpdateController')->name('update');
            Route::delete('/{expenseType}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'IncomeType', 'as' => 'incomeType.', 'prefix' => 'incomeTypes'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{incomeType}', 'ShowController')->name('show');
            Route::get('/{incomeType}/edit', 'EditController')->name('edit');
            Route::patch('/{incomeType}', 'UpdateController')->name('update');
            Route::delete('/{incomeType}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Expense', 'as' => 'expense.', 'prefix' => 'expenses'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{expense}', 'ShowController')->name('show');
            Route::get('/{expense}/edit', 'EditController')->name('edit');
            Route::patch('/{expense}', 'UpdateController')->name('update');
            Route::delete('/{expense}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Income', 'as' => 'income.', 'prefix' => 'incomes'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{income}', 'ShowController')->name('show');
            Route::get('/{income}/edit', 'EditController')->name('edit');
            Route::patch('/{income}', 'UpdateController')->name('update');
            Route::delete('/{income}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Client', 'as' => 'client.', 'prefix' => 'clients'], function () {
            Route::get('/filter/{filter?}', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{client}', 'ShowController')->name('show');
            Route::get('/{client}/edit', 'EditController')->name('edit');
            Route::get('/{client}/spam/{return?}/{id_return?}', 'SpamController')->name('spam');
            Route::patch('/{client}', 'UpdateController')->name('update');
            Route::delete('/{client}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Site', 'as' => 'site.', 'prefix' => 'sites'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{site}', 'ShowController')->name('show');
            Route::get('/{site}/edit', 'EditController')->name('edit');
            Route::patch('/{site}', 'UpdateController')->name('update');
            Route::delete('/{site}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Phone', 'as' => 'phone.', 'prefix' => 'phones'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{phone}', 'ShowController')->name('show');
            Route::get('/{phone}/edit', 'EditController')->name('edit');
            Route::patch('/{phone}', 'UpdateController')->name('update');
            Route::delete('/{phone}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'TechnicsType', 'as' => 'technicsType.', 'prefix' => 'technics-types'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{technics_type}', 'ShowController')->name('show');
            Route::get('/{technics_type}/edit', 'EditController')->name('edit');
            Route::patch('/{technics_type}', 'UpdateController')->name('update');
            Route::delete('/{technics_type}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'BrokenType', 'as' => 'brokenType.', 'prefix' => 'broken-types'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{broken_type}', 'ShowController')->name('show');
            Route::get('/{broken_type}/edit', 'EditController')->name('edit');
            Route::patch('/{broken_type}', 'UpdateController')->name('update');
            Route::delete('/{broken_type}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'SparePart', 'as' => 'sparePart.', 'prefix' => 'spare-part'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{sparePart}', 'ShowController')->name('show');
            Route::get('/{sparePart}/edit', 'EditController')->name('edit');
            Route::patch('/{sparePart}', 'UpdateController')->name('update');
            Route::delete('/{sparePart}', 'DeleteController')->name('delete');
        });

        Route::group(['namespace' => 'Brand', 'as' => 'brand.', 'prefix' => 'brands'], function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/', 'StoreController')->name('store');
            Route::get('/{brand}', 'ShowController')->name('show');
            Route::get('/{brand}/edit', 'EditController')->name('edit');
            Route::patch('/{brand}', 'UpdateController')->name('update');
            Route::delete('/{brand}', 'DeleteController')->name('delete');
        });

})->name('crm.');


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
    'email' => false,
]);
