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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('brand', 'BrandController');
Route::resource('category', 'CategoryController');
Route::resource('contact', 'ContactController');
Route::resource('product', 'ProductController');
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::post('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/password', 'PasswordController@index')->name('password.index');
Route::post('/password', 'PasswordController@update')->name('password.update');
Route::get('/contact-download/pdf', 'ContactController@downloadPdf')->name('contact.download.pdf');
Route::get('/contact-download/xls', 'ContactController@downloadExcel')->name('contact.download.excel');

Route::group(['prefix' => 'datatable'], function() {
    Route::get('/contact', 'DatatableController@contact')->name('datatable.contact');
    Route::get('/category', 'DatatableController@category')->name('datatable.category');
    Route::get('/brand', 'DatatableController@brand')->name('datatable.brand');
    Route::get('/product', 'DatatableController@product')->name('datatable.product');
});