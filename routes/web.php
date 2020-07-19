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

Route::get('/','ProductController@index');

Auth::routes();


Route::get('/home','ProductController@index')->name('home');


Route::get('/product','ProductController@index')->name('product');
Route::get('/product/create','ProductController@create')->name('product.create');
Route::put('/product/store','productController@store')->name('product.store');
Route::get('/product/{id}','ProductController@show')->name('product.show');
Route::get('/product/edit/{id}','ProductController@edit')->name('product.edit');
Route::patch('/product/update/{id}','ProductController@update')->name('product.update');
Route::get('/product/destroy/{id}','ProductController@destroy')->name('product.destroy');


Route::get('/category','CategoryController@index')->name('category');
Route::get('/category/create','CategoryController@create')->name('category.create');
Route::put('/category/store','CategoryController@store')->name('category.store');
Route::get('/category/{id}/destroy','CategoryController@destroy')->name('category.destroy');