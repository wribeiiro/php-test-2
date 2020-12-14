<?php

namespace App\Controllers;

use App\System\Controller;
use App\Helpers\Util;

class ProductsTypeController extends Controller {

    private $model;

    public function __construct() {

    }

    public function index() {
        Util::view('layout/header');
        Util::view('layout/menu');
        Util::view('products/index');
        Util::view('layout/footer');
    }
}
