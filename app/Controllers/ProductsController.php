<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\Response;
use App\System\Controller;
use App\Services\ProductsService;
use App\Repositories\ProductsTypeRepository;

class ProductsController extends Controller
{
    protected $products_service;

    public function __construct()
    {
        $this->products_service = new ProductsService();
        $this->data['productsType'] = (new ProductsTypeRepository())->get();
    }

    public function index(): void
    {
        View::include('layout/header');
        View::include('layout/menu');
        View::include('products/index', $this->data);
        View::include('layout/footer');
    }

    public function getProducts()
    {
        try {
            $this->response['code'] = Response::HTTP_OK;
            $this->response['data'] = $this->products_service->getAll();
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }

    public function createProduct()
    {
        $data = $this->inputPost();

        $this->response['code'] = Response::HTTP_CREATED;
        $this->response['data'] = [];

        try {
            $result = $this->products_service->create($data);

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

    public function updateProduct(int $id)
    {
        $data = $this->inputPost();

        $this->response['code'] = Response::HTTP_OK;
        $this->response['data'] = [];

        try {
            $result = $this->products_service->update($data, $id);

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

    public function deleteProduct(int $id)
    {
        try {
            $this->response['code'] = Response::HTTP_OK;
            $this->response['data'] = $this->products_service->delete($id);
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }
}
