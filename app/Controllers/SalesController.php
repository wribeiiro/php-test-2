<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\Response;
use App\System\Controller;
use App\Services\SalesService;
use App\Repositories\ProductsRepository;

class SalesController extends Controller
{
    private $sales_services;

    public function __construct()
    {
        $this->sales_services = new SalesService();
        $this->data['products'] = (new ProductsRepository())->get();
    }

    public function index(): void
    {
        View::include('layout/header');
        View::include('layout/menu', );
        View::include('sales/index', $this->data);
        View::include('layout/footer');
    }
    
    public function getSales()
    {
        try {
            $this->response['code'] = Response::HTTP_OK;
            $this->response['data'] = $this->sales_services->getAll();
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }

    public function getItems(int $id)
    {
        try {
            $this->response['code'] = Response::HTTP_OK;
            $this->response['data'] = $this->sales_services->getItems($id);
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }

    public function createSale()
    {
        $data = $this->inputJSON();

        $this->response['code'] = 201;
        $this->response['data'] = [];

        try {
            $result = $this->sales_services->create($data);

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

    public function deleteSale(int $id)
    {
        try {
            $this->response['code'] = Response::HTTP_OK;
            $this->response['data'] = $this->sales_services->delete($id);
        } catch (\Exception $e) {
            $this->response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->response['data'] = $e->getMessage();
        }

        return Response::respond($this->response, $this->response['code']);
    }
}
