<?php

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

Route::get('/', function () {
    return redirect('trang-chu');
});

// Site
Route::group(['namespace' => 'App\Http\Controllers\Site'], function () {

    Route::get('trang-chu', 'HomeController@homeShow')->name('site.home.homeShow');
    
    Route::post('tim-kiem', 'HomeController@find')->name('site.home.find');

    Route::get('lien-he', 'HomeController@contactShow')->name('site.contact.contactShow');
    
    Route::get('chinh-sach', 'HomeController@policyShow')->name('site.policy.policyShow');

    Route::get('vb/{id}', 'HomeController@verifyBatch')->name('site.batch.verifyBatch');

    Route::get('ab/{id}', 'HomeController@accessBatch')->name('site.batch.accessBatch');

    Route::get('vp/{id}', 'HomeController@verifyProduct')->name('site.batch.verifyProduct');

    Route::get('ap/{id}', 'HomeController@accessProduct')->name('site.batch.accessProduct');
});   

// Qrcode
Route::group(['namespace' => 'App\Http\Controllers\Qrcode'], function () {

    Route::group(['prefix' => 'lo-hang'], function () {
        Route::get('/', 'BatchController@batchShow')->name('qrcode.batch.batchShow');

        Route::get('them', 'BatchController@batchCreateShow')->name('qrcode.batch.batchCreateShow');
        Route::post('them', 'BatchController@batchCreate')->name('qrcode.batch.batchCreate');

        Route::get('chi-tiet/{id}', 'BatchController@batchDetail')->name('qrcode.batch.batchDetail');

        Route::get('sua/{id}', 'BatchController@batchUpdateShow')->name('qrcode.batch.batchUpdateShow');
        Route::post('sua/{id}', 'BatchController@batchUpdate')->name('qrcode.batch.batchUpdate');

        Route::post('xoa', 'BatchController@batchDelete')->name('qrcode.batch.batchDelete');

        Route::get('tao-xac-minh/{id}', 'BatchController@createVerifyWord')->name('qrcode.batch.createVerifyWord');
        Route::get('tao-truy-xuat/{id}', 'BatchController@createAccessWord')->name('qrcode.batch.createAccessWord');
        
    });

    Route::group(['prefix' => 'san-pham'], function () {
        Route::get('/', 'ProductController@productListShow')->name('qrcode.product.productListShow');
    
        Route::get('them', 'ProductController@productListCreateShow')->name('qrcode.product.productListCreateShow');
        Route::post('them', 'ProductController@productListCreate')->name('qrcode.product.productListCreate');

        Route::get('chi-tiet/{id}', 'ProductController@productListDetail')->name('qrcode.product.productListDetail');

        Route::get('sua/{id}', 'ProductController@productListUpdateShow')->name('qrcode.product.productListUpdateShow');
        Route::post('sua/{id}', 'ProductController@productListUpdate')->name('qrcode.product.productListUpdate');

        Route::post('xoa', 'ProductController@productListDelete')->name('qrcode.product.productListDelete');

        Route::get('tao-truy-xuat/{id}', 'ProductController@createAccessWord')->name('qrcode.product.createAccessWord');
        Route::get('tao-xac-minh/{id}', 'ProductController@createVerifyWord')->name('qrcode.product.createVerifyWord');
    });

    Route::get('test', function () {
        return SimpleSoftwareIO\QrCode\Facades\QrCode::size(500)->generate('Welcome to kerneldev.com!');
    })->name('qrcode.test');
});
