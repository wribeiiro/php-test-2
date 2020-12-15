<?php 

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('App\Controllers');
SimpleRouter::get('/',                  'SalesController@index');
SimpleRouter::get('/products',             'ProductsController@index');
SimpleRouter::get('/products-type',             'ProductsTypeController@index');

SimpleRouter::get('/sales/getAll', 'SalesController@getSales');
SimpleRouter::get('/sales/getItems/{id}', 'SalesController@getItems');
SimpleRouter::post('/sales/create', 'SalesController@createSale');
SimpleRouter::post('/sales/update/{id}', 'SalesController@updateSale');
SimpleRouter::delete('/sales/delete/{id}', 'SalesController@deleteSale');

SimpleRouter::get('/products/getAll', 'ProductsController@getProducts');
SimpleRouter::post('/products/create', 'ProductsController@createProduct');
SimpleRouter::post('/products/update/{id}', 'ProductsController@updateProduct');
SimpleRouter::delete('/products/delete/{id}', 'ProductsController@deleteProduct');

SimpleRouter::get('/products-type/getAll', 'ProductsTypeController@getProductsType');
SimpleRouter::post('/products-type/create', 'ProductsTypeController@createProductType');
SimpleRouter::post('/products-type/update/{id}', 'ProductsTypeController@updateProductType');
SimpleRouter::delete('/products-type/delete/{id}', 'ProductsTypeController@deleteProductType');