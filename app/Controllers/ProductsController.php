<?php

namespace App\Controllers;

use App\System\Controller;
use App\Helpers\View;
use App\Helpers\Response;
use App\Services\ProductsService;
use App\Repositories\ProductsTypeRepository;

class ProductsController extends Controller {

    protected $products_service;

    public function __construct() {
        $this->products_service = new ProductsService();
        $this->data['productsType'] = (new ProductsTypeRepository())->get();
    }

    public function index() {
        View::include('layout/header');
        View::include('layout/menu');
        View::include('products/index', $this->data);
        View::include('layout/footer');
    }

    public function getProducts() {

        try {
            $response['code'] = Response::HTTP_OK;
            $response['data'] = $this->products_service->getAll();
        } catch (\Exception $e) {
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function createProduct() {
        $data = $this->inputPost();

        $response['code'] = Response::HTTP_CREATED;
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
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function updateProduct(int $id) {
        $data = $this->inputPost();

        $response['code'] = Response::HTTP_OK;
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
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function deleteProduct(int $id) {

        try {
            $response['code'] = Response::HTTP_OK;
            $response['data'] = $this->products_service->delete($id);
        } catch (\Exception $e) {
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }
}
