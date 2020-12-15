<?php

namespace App\Repositories;

use App\Models\SaleModel;
use App\Repositories\Interfaces\RepositoryInterface;

class SalesRepository implements RepositoryInterface {

    /**
     * @var SaleModel
     */
    private $model;

    public function __construct() {
        $this->model = new SaleModel(); 
    }

    public function get() {
        $sql = "SELECT 
                    id, client_name, total_price, total_tax, created_at, SUM(total_price + total_tax) as total_sale 
                FROM 
                    sales
                GROUP BY
                    id 
                ORDER BY 
                    id DESC";
        
        return $this->model->executeQuery($sql);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(int $id, array $data) {
        return $this->model->update($id, $data);
    }

    public function delete(int $id) {
        return $this->model->delete($id);
    }

    public function deleteItem(int $saleId) {
        return $this->model->deleteItem($saleId);
    }

    public function createItem(array $data) {
        return $this->model->create($data, "sales_item");
    }

    public function getItems(int $id) {
        $sql = "SELECT 
                    sales_item.*, 
                    products.description as product_name
                FROM 
                    sales_item 
                INNER JOIN
                    products ON sales_item.product_id = products.id
                INNER JOIN
                    products_type ON products.product_type_id = products_type.id
                WHERE 
                    sale_id = {$id} 
                ORDER BY 
                    id DESC";
        
        return $this->model->executeQuery($sql);
    }
}
