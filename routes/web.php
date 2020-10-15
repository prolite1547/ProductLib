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

Route::get('/', function(){
    return redirect()->route('products.view');
})->name('products');

Route::get('/appredirect/{user}', 'AppRedirectController@authenticate')->name('user.authenticate');
Route::post('/appredirects/auth', 'AppRedirectController@checkUser')->name('user.checkUser');

Route::get('/products','AdminController@productsView')->name('products.view');
Route::get('/reports','AdminController@reportView')->name('report.view');



Route::get('/manage-product/add', 'AdminController@addProductView')->name('addproduct.view');

Route::post('/add-product', 'ProductController@addProduct')->name('addproduct.add');
Route::get('/get/product-details/{barcode}', 'ProductController@getProductDetails')->name('get.productdetails');
Route::post('/update-product', 'ProductController@updateProduct')->name('updateproduct.update');
Route::post('/delete-product', 'ProductController@deleteProduct')->name('deleteproduct.delete');

Route::get('/api-products', 'DatatablesController@getProducts')->name('get.products');

Route::get('/api-brands', 'ReportController@getBrand')->name('get.brands');
Route::get('/api-dimension', 'ReportController@getDimension')->name('get.dimension');

Route::post('/generate-report', 'ReportController@generateReport')->name('gen.report');

Route::get('/check-updates', 'ProductController@checkUpdates')->name('check.updates');
Auth::routes();

 
