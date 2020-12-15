<?php

namespace App\Controllers;

use App\System\Controller;
use App\Services\SalesService;
use App\Helpers\Util;
use App\Repositories\ProductsRepository;

class SalesController extends Controller {

    private $sales_services;

    public function __construct() {
        $this->sales_services = new SalesService(); 
        $this->data['products'] = (new ProductsRepository())->get();
    }

    public function index() {
        Util::view('layout/header');
        Util::view('layout/menu',);
        Util::view('sales/index', $this->data);
        Util::view('layout/footer');
    }
    
    public function getSales() {

        try {
            $response['code'] = 200;
            $response['data'] = $this->sales_services->getAll();
        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response, $response['code']);
    }

    public function getItems(int $id) {

        try {
            $response['code'] = 200;
            $response['data'] = $this->sales_services->getItems($id);
        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response, $response['code']);
    }

    public function createProduct() {
        $data = $this->inputPost();

        $response['code'] = 201;
        $response['data'] = [];

        try {
            $result = $this->sales_services->create($data);

            if (isset($result['code']) && !empty($result['code'])) {
                $response['code'] = $result['code'];
                $response['data'] = $result['data'];
            } else {
                $response['data'] = $result;
            }

        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response, $response['code']);
    }

    public function updateProduct(int $id) {
        $data = $this->inputPost();

        $response['code'] = 200;
        $response['data'] = [];

        try {
            $result = $this->sales_services->update($data, $id);

            if (isset($result['code']) && !empty($result['code'])) {
                $response['code'] = $result['code'];
                $response['data'] = $result['data'];
            } else {
                $response['data'] = $result;
            }

        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response, $response['code']);
    }

    public function deleteProduct(int $id) {

        try {
            $response['code'] = 200;
            $response['data'] = $this->sales_services->delete($id);
        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response, $response['code']);
    }
}
