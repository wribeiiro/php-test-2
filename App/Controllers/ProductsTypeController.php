<?php

namespace App\Controllers;

use App\System\Controller;
use App\Helpers\Util;
use App\Services\ProductsTypeService;

class ProductsTypeController extends Controller {

    protected $products_type_service;

    public function __construct() {
        $this->products_type_service = new ProductsTypeService();
    }

    public function index() {
        Util::view('layout/header');
        Util::view('layout/menu');
        Util::view('products-type/index');
        Util::view('layout/footer');
    }

    public function getProductsType() {

        try {
            $response['code'] = 200;
            $response['data'] = $this->products_type_service->getAll();
        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response, $response['code']);
    }

    public function createProductType() {
        $data = $this->inputPost();

        $response['code'] = 201;
        $response['data'] = [];

        try {
            $result = $this->products_type_service->create($data);

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

    public function updateProductType(int $id) {
        $data = $this->inputPost();

        $response['code'] = 200;
        $response['data'] = [];

        try {
            $result = $this->products_type_service->update($data, $id);

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

    public function deleteProductType(int $id) {

        try {
            $response['code'] = 200;
            $response['data'] = $this->products_type_service->delete($id);
        } catch (\Exception $e) {
            $response['code'] = 500;
            $response['data'] = $e->getMessage();
        }

        return Util::response($response);
    }
}
