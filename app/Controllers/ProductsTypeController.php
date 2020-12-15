<?php

namespace App\Controllers;

use App\System\Controller;
use App\Helpers\View;
use App\Helpers\Response;
use App\Services\ProductsTypeService;

class ProductsTypeController extends Controller {

    protected $products_type_service;

    public function __construct() {
        $this->products_type_service = new ProductsTypeService();
    }

    public function index() {
        View::include('layout/header');
        View::include('layout/menu');
        View::include('products-type/index');
        View::include('layout/footer');
    }

    public function getProductsType() {

        try {
            $response['code'] = Response::HTTP_OK;
            $response['data'] = $this->products_type_service->getAll();
        } catch (\Exception $e) {
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function createProductType() {
        $data = $this->inputPost();

        $response['code'] = Response::HTTP_CREATED;
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
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function updateProductType(int $id) {
        $data = $this->inputPost();

        $response['code'] = Response::HTTP_OK;
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
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function deleteProductType(int $id) {

        try {
            $response['code'] = Response::HTTP_OK;
            $response['data'] = $this->products_type_service->delete($id);
        } catch (\Exception $e) {
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response);
    }
}
