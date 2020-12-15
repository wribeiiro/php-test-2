<?php

namespace App\Controllers;

use App\System\Controller;
use App\Helpers\Util;
use App\Services\ProductsService;
use App\Repositories\ProductsTypeRepository;

class ProductsController extends Controller {

    protected $products_service;

    public function __construct() {
        $this->products_service = new ProductsService();
        $this->data['productsType'] = (new ProductsTypeRepository())->get();
    }

    public function index() {
        Util::view('layout/header');
        Util::view('layout/menu');
        Util::view('products/index', $this->data);
        Util::view('layout/footer');
    }

    public function getProducts() {

        try {
            $response['code'] = 200;
            $response['data'] = $this->products_service->getAll();
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
            $result = $this->products_service->create($data);

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
            $result = $this->products_service->update($data, $id);

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
            $response['data'] = $this->products_service->delete($id);
        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response, $response['code']);
    }
}
