<?php

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

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['auth','user_is_admin'],function(){

    //units
    Route::get('units', 'UnitController@index')->name('units');
    Route::post('units', 'UnitController@store')->name('unit.store');
    Route::delete('units', 'UnitController@delete')->name('unit.delete');
    Route::put('units', 'UnitController@update')->name('unit.update');
    Route::get('search-units', 'UnitController@search')->name('unit.search');

    //categories
    Route::get('categories', 'CategoryController@index')->name('categories');
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    Route::get('categories-search', 'CategoryController@search')->name('categories.search');
    Route::put('categories', 'CategoryController@update')->name('categories.update');
    Route::delete('categories', 'CategoryController@delete')->name('categories.delete');

    //products
    Route::get('products', 'ProductController@index')->name('products');
    Route::get('new-product', 'ProductController@newproduct')->name('new-product');
    Route::post('new-product', 'ProductController@store');
    Route::post('delete-image' , 'ProductController@deleteImage')->name('delete-image');
    Route::get('update-product/{id}', 'ProductController@newproduct')->name('update-new-product');
    Route::put('update-product', 'ProductController@update')->name('update-product');
    Route::delete('products/{id}', 'ProductController@delete')->name('product.delete');

    //tags
    Route::get('tags', 'TagController@index')->name('tags');
    Route::post('tags', 'TagController@store')->name('tag.store');
    Route::get('tags-search', 'TagController@search')->name('tag.search');
    Route::put('tags', 'TagController@update')->name('tag.update');
    Route::delete('tags', 'TagController@delete')->name('tag.delete');

    //payments
    //orders
    //shipment

    //countries
    Route::get('countries', 'CountryController@index')->name('coutries');


    //cities
    Route::get('cities', 'CityController@index')->name('cities');

    //states
    Route::get('states', 'StateController@index')->name('states');

    //reviews
    Route::get('reviews', 'ReviewController@index')->name('reviews');

    //roles
    Route::get('roles' , 'RoleController@index')->name('roles');

    //tickits
    Route::get('tickets' , 'TicketController@index')->name('tickets');

});


// To Import unit data to db
     Route::get('unit-test' , 'DataImportController@importUnits');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

