<?php

require __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('App\Controllers');
SimpleRouter::get('/',                 'HomeController@index');
SimpleRouter::get('/get-sales',        'HomeController@getSales');
SimpleRouter::get('/get-sales/{id}',   'HomeController@getSale');
SimpleRouter::get('/create-sale',      'HomeController@createSale');
SimpleRouter::get('/update-sale/{id}', 'HomeController@updateSale');
SimpleRouter::get('/delete-sale/{id}', 'HomeController@deleteSale');

SimpleRouter::get('/products',            'ProductsController@index');
SimpleRouter::get('/get-products',        'ProductsController@getProducts');
SimpleRouter::get('/get-products/{id}',   'ProductsController@getProduct');
SimpleRouter::get('/create-product',      'ProductsController@storeProduct');
SimpleRouter::get('/update-product/{id}', 'ProductsController@editProduct');
SimpleRouter::get('/delete-product/{id}', 'ProductsController@deleteProduct');

SimpleRouter::get('/product-types',            'ProductsTypeController@index');
SimpleRouter::get('/get-product-types',        'ProductsTypeController@getProductTypes');
SimpleRouter::get('/get-product-types/{id}',   'ProductsTypeController@getProductType');
SimpleRouter::get('/create-product-type',      'ProductsController@storeProductType');
SimpleRouter::get('/update-product-type/{id}', 'ProductsController@editProductType');
SimpleRouter::get('/delete-product-type/{id}', 'ProductsController@deleteProductType');

SimpleRouter::start();