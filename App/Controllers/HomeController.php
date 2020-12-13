<?php

namespace App\Controllers;

use App\System\Controller;
use App\Models\HomeModel;
use App\Helpers\Util;

class HomeController extends Controller {

    private $model;

    public function __construct() {
        $this->model = new HomeModel(); 
    }

    public function index() {
        $body["teste"] = '0ok';

        Util::view('layout/header', $body);
        Util::view('layout/menu', $body);
        Util::view('home/index', $body);
        Util::view('layout/footer', $body);
    }

    public function products() {
        Util::view('layout/header');
        Util::view('layout/menu');
        Util::view('products/index');
        Util::view('layout/footer');
    }

    public function productsType() {
        Util::view('layout/header');
        Util::view('layout/menu');
        Util::view('products/index');
        Util::view('layout/footer');
    }
}
