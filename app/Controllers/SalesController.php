<?php

namespace App\Controllers;

use App\System\Controller;
use App\Services\SalesService;
use App\Helpers\View;
use App\Helpers\Response;
use App\Repositories\ProductsRepository;

class SalesController extends Controller {

    private $sales_services;

    public function __construct() {
        $this->sales_services = new SalesService(); 
        $this->data['products'] = (new ProductsRepository())->get();
    }

    public function index() {
        View::include('layout/header');
        View::include('layout/menu',);
        View::include('sales/index', $this->data);
        View::include('layout/footer');
    }
    
    public function getSales() {

        try {
            $response['code'] = Response::HTTP_OK;
            $response['data'] = $this->sales_services->getAll();
        } catch (\Exception $e) {
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function getItems(int $id) {

        try {
            $response['code'] = Response::HTTP_OK;
            $response['data'] = $this->sales_services->getItems($id);
        } catch (\Exception $e) {
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function createSale() {
        $data = $this->inputJSON();

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
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }

    public function deleteSale(int $id) {

        try {
            $response['code'] = Response::HTTP_OK;
            $response['data'] = $this->sales_services->delete($id);
        } catch (\Exception $e) {
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = $e->getMessage();
        }

        return Response::respond($response, $response['code']);
    }
}
