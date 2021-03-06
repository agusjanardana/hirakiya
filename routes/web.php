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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id?}', 'DetailController@index')->name('detail');
Route::post('/details/{id?}', 'DetailController@add')->name('detail-add');

Route::get('/success', 'CartController@success')->name('success');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::get('/search', 'SearchProductController@search')->name('search');

Route::resource('comment', 'CommentsController');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details'); // {id}
    Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update'); // {id}
    Route::get('/dashboard/transactions/buy/{id}', 'DashboardTransactionController@detailsBuy')->name('dashboard-transaction-details-buy'); // {id}



    Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-product-create');
    Route::post('/dashboard/products/store', 'DashboardProductController@store')->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@detail')->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
    Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');
    
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
    Route::post('/wishlist', 'WishlistController@store')->name('wishlist-store');
    Route::get('/wishlist/{id}', 'WishlistController@destroy')->name('wishlist-delete');
    
    
});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
        Route::resource('transaction', 'DashboardTransactionController');
        Route::resource('dynamicfe', 'DynamicFrontendController');
    });

Auth::routes();
