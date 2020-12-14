<?php

namespace App\Controllers;

use App\System\Controller;
use App\Helpers\Util;

class ProductsController extends Controller {

    private $model;

    public function __construct() {

    }

    public function index() {
        Util::view('layout/header');
        Util::view('layout/menu');
        Util::view('products/index');
        Util::view('layout/footer');
    }

    public function getProducts() {

    }

    public function getProduct(int $id) {
        
    }

    public function create() {

    }

    public function update(int $id) {

    }

    public function delete(int $id) {

    }
}
