<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\Response;
use App\System\Controller;
use App\Services\ProductsTypeService;

class ProductsTypeController extends Controller
{
    protected $products_type_service;

    public function __construct()
    {
        $this->products_type_service = new ProductsTypeService();
    }

    public function index(): void
    {
        View::include('layout/header');
        View::include('layout/menu');
        View::include('products-type/index');
        View::include('layout/footer');
    }

    public function getProductsType()
    {
        try {
            $this->response['code'] = Response::HTTP_OK;
            $this->response['data'] = $this->products_type_service->getAll();
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }

    public function createProductType()
    {
        $data = $this->inputPost();

        $this->response['code'] = Response::HTTP_CREATED;
        $this->response['data'] = [];

        try {
            $result = $this->products_type_service->create($data);

            if (isset($result['code']) && !empty($result['code'])) {
                $this->response['code'] = $result['code'];
                $this->response['data'] = $result['data'];
            } else {
                $this->response['data'] = $result;
            }
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }

    public function updateProductType(int $id)
    {
        $data = $this->inputPost();

        $this->response['code'] = Response::HTTP_OK;
        $this->response['data'] = [];

        try {
            $result = $this->products_type_service->update($data, $id);

            if (isset($result['code']) && !empty($result['code'])) {
                $this->response['code'] = $result['code'];
                $this->response['data'] = $result['data'];
            } else {
                $this->response['data'] = $result;
            }
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }

    public function deleteProductType(int $id)
    {
        try {
            $this->response['code'] = Response::HTTP_OK;
            $this->response['data'] = $this->products_type_service->delete($id);
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response);
    }
}
