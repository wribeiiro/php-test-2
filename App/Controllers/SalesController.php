<?php

namespace App\Controllers;

use App\System\Controller;
use App\Models\SaleModel;
use App\Helpers\Util;

class SalesController extends Controller {

    private $model;

    public function __construct() {
        $this->model = new SaleModel(); 
    }

    public function index() {
        $body["teste"] = '0ok';

        Util::view('layout/header', $body);
        Util::view('layout/menu', $body);
        Util::view('sales/index', $body);
        Util::view('layout/footer', $body);
    }
    
    public function getSales() {

    }

    public function getSale(int $id) {
        
    }

    public function create() {

    }

    public function update(int $id) {

    }

    public function delete(int $id) {

    }
}
