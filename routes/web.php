<?php

use Illuminate\Support\Facades\Redirect;
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


Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

Route::get('/about', 'App\Http\Controllers\IndexController@abount')->name('about');
Route::get('/services', 'App\Http\Controllers\IndexController@services')->name('services');
Route::get('/articles', 'App\Http\Controllers\IndexController@articles')->name('articles');
Route::get('/contacts', 'App\Http\Controllers\IndexController@contacts')->name('contacts');
Route::get('/basket', 'App\Http\Controllers\BasketController@index');
Route::get('/delivery', 'App\Http\Controllers\IndexController@delivery');

Route::get('/catalog/{category?}/{product}', 'App\Http\Controllers\ProductController@product')->where('category','.*')->where('product','[0-9]+');
Route::get('/catalog/{category?}', 'App\Http\Controllers\ProductController@index')->where('category','.*')->name('catalog');


Route::post('/oneClick', 'App\Http\Controllers\OrderController@oneClick')->name('oneClick');
Route::post('/confirmOrder', 'App\Http\Controllers\OrderController@confirmOrder');
Route::post('/toBasket', 'App\Http\Controllers\BasketController@toBasket');
Route::post('/basket/upload', 'App\Http\Controllers\BasketController@upload');
Route::get('/getBasket', 'App\Http\Controllers\BasketController@getBasketData');
Route::get('/updateProductInBasket', 'App\Http\Controllers\BasketController@updateProductInBasket');
Route::get('/deleteProductInBasket', 'App\Http\Controllers\BasketController@deleteProductInBasket');
Route::get('/search', 'App\Http\Controllers\ProductController@search')->name('search');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', function (){
      return redirect('/admin/orders');
    });
    Route::get('/admin/orders', 'App\Http\Controllers\Admin\OrderController@index')->name('admin.orders');
    Route::get('/admin/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name('admin.categories');
    Route::post('/admin/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@store');
    Route::get('/admin/products', 'App\Http\Controllers\Admin\ProductController@index')->name('admin.products');
    Route::get('/admin/getCateoriesById', 'App\Http\Controllers\Admin\ProductController@getCateoriesById');

    
});
Route::get('/dev/refreshdb', 'App\Http\Controllers\DevController@refreshdb')->name('dev.refreshdb');
Route::get('/dev/setseocategories', 'App\Http\Controllers\DevController@set_seo_cat');
Route::get('/dev/setseoproducts', 'App\Http\Controllers\DevController@set_seo_product');


