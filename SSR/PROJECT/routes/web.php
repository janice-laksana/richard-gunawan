<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     // return redirect('home');
//     // return view('home');
//     return view('home', [
//         'recentjasa' => [],
//         'recojasa' => []
//     ]);
// });

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/resetrecommend', 'HomeController@resetrecommend');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/goSearch/{search}', 'User\JasaController@saveSearch');
    Route::get('/clearSearch', 'User\JasaController@clearSearch');

    Route::group(['prefix' => 'jasa'], function () {
        Route::get('/ajax', 'User\JasaController@ajaxIndexPublic');
        Route::get('/{id}', 'User\JasaController@indexPublic');
    });

    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('/', 'User\WishlistController@index');
        Route::post('/ajaxMyWish', 'User\WishlistController@ajaxMyWish');
        Route::get('/{iduser}/{idjasa}', 'User\WishlistController@edit');
    });


    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'User\ProfileController@index');
        Route::post('/update/{action}', 'User\ProfileController@update');
        Route::post('/insert/{action}', 'User\ProfileController@store');
    });

    Route::group(['prefix' => 'buyer'], function () {
        Route::group(['prefix' => 'transaction'], function () {
            Route::get('/', 'User\Buyer\TransactionController@index');
            Route::post('/add', 'User\Buyer\TransactionController@store');
            Route::get('/{id}', 'User\Buyer\TransactionController@show');
        });
        Route::group(['prefix' => 'request'], function () {
            Route::get('/', 'User\Buyer\RequestController@index');
            Route::get('/add', 'User\Buyer\RequestController@create');
            Route::post('/add', 'User\Buyer\RequestController@store');
            Route::get('/order', 'User\Buyer\RequestController@order');
            Route::delete('/delete', 'User\Buyer\RequestController@destroy');
            Route::get('/{id}', 'User\Buyer\RequestController@show');
        });
    });

    Route::group(['prefix' => 'seller'], function () {
        Route::group(['prefix' => 'transaction'], function () {
            Route::get('/', 'User\Seller\TransactionController@index');
            Route::get('/accept/{id}', 'User\Seller\TransactionController@accept');
            Route::get('/decline/{id}', 'User\Seller\TransactionController@decline');
            Route::get('/finish/{id}', 'User\Seller\TransactionController@finish');
            Route::get('/{id}', 'User\Seller\TransactionController@show');
        });

        Route::group(['prefix' => 'offer'], function () {
            Route::get('/', 'User\Seller\OfferController@index');
            Route::get('/add', 'User\Seller\OfferController@create');
            Route::post('/add/{id}', 'User\Seller\OfferController@store');
            Route::get('/order', 'User\Seller\OfferController@order');
            Route::delete('/delete', 'User\Seller\OfferController@destroy');
            Route::get('/{id}', 'User\Seller\OfferController@show');
        });

        Route::group(['prefix' => 'jasa'], function () {
            Route::get('/', 'User\JasaController@index')->name('jasaIndex');
            Route::post('/store', 'User\JasaController@store')->name('jasaStore');
            Route::get('/show/{id}', 'User\JasaController@show')->name('jasaDetail');
            Route::post('/order', 'User\JasaController@order');
            Route::post('/update/{id}', 'User\JasaController@update');
            Route::post('/delete', 'User\JasaController@ajaxCancel');
            Route::get('/create/{action}', 'User\JasaController@create')->name('jasaCreate');

            Route::post('/doCreate/{action}', 'User\JasaController@doCreate');
            Route::post('/ajaxMyJasa', 'User\JasaController@ajaxMyJasa');
            Route::post('/showupdate', 'User\JasaController@showUpdate');

            Route::post('/addReview/{id}', 'User\JasaController@addReview');

        });

    });

    Route::group(['prefix' => 'request'], function () {
        Route::get('/', 'User\RequestController@index');
        Route::get('/loadData', 'User\RequestController@loadData');
        Route::get('/add', 'User\RequestController@create');
        Route::post('/add/{id}', 'User\RequestController@store');
        Route::get('/order', 'User\RequestController@order');
        Route::delete('/delete', 'User\RequestController@destroy');
        Route::get('/{id}', 'User\RequestController@show');

    });

    Route::group(['prefix' => 'chat'], function () {
        Route::get('/', 'ChatController@index');
        Route::post('/send', 'ChatController@send');
    });

});

Route::group(['middleware' => ['auth','authadmin']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index');
        Route::get('/user', 'AdminController@user');
        Route::get('/jasa', 'AdminController@jasa');
        Route::get('/request', 'AdminController@request');
        Route::get('/actionuser/{id}', 'AdminController@actionuser');
        Route::get('/actionjasa/{id}/{action}', 'AdminController@actionjasa');
        Route::get('/actionrequest/{id}/{action}', 'AdminController@actionrequest');
        Route::get('/getdatadashboard', 'AdminController@getdatadashboard');
        Route::post('/gettrans', 'AdminController@gettrans');
    });
});
