<?php

require __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('App\Controllers');
SimpleRouter::get('/',                  'SalesController@index');
SimpleRouter::get('/sales/getAll',      'SalesController@getSales');
SimpleRouter::get('/sales/get/{id}',    'SalesController@getSale');
SimpleRouter::get('/sales/create',      'SalesController@createSale');
SimpleRouter::get('/sales/update/{id}', 'SalesController@updateSale');
SimpleRouter::get('/sales/delete/{id}', 'SalesController@deleteSale');

SimpleRouter::get('/products',             'ProductsController@index');
SimpleRouter::get('/products/getAll',      'ProductsController@getProducts');
SimpleRouter::get('/products/get/{id}',    'ProductsController@getProduct');
SimpleRouter::get('/products/create',      'ProductsController@storeProduct');
SimpleRouter::get('/products/update/{id}', 'ProductsController@editProduct');
SimpleRouter::get('/products/delete/{id}', 'ProductsController@deleteProduct');

SimpleRouter::get('/product-types',             'ProductsTypeController@index');
SimpleRouter::get('/product-types/getAll',      'ProductsTypeController@getProductTypes');
SimpleRouter::get('/product-types/get/{id}',    'ProductsTypeController@getProductType');
SimpleRouter::get('/product-types/create',      'ProductsController@storeProductType');
SimpleRouter::get('/product-types/update/{id}', 'ProductsController@editProductType');
SimpleRouter::get('/product-types/delete/{id}', 'ProductsController@deleteProductType');

SimpleRouter::start();