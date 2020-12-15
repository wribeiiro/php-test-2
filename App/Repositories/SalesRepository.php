<?php

namespace App\Repositories;

use App\Models\SaleModel;

class SalesRepository {

    private $model;

    public function __construct() {
        $this->model = new SaleModel(); 
    }
    
    public function get() {
        $sql = "SELECT * FROM sales ORDER BY id DESC";
        
        return $this->model->db->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public function getItems($id) {
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
        
        return $this->model->db->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public function create(array $data) {

        $fields = array_keys($data);
        $binds  = array_pad([], count($fields), '?');

        $sql = 'INSERT INTO sales ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';
        $stm = $this->model->db->prepare($sql);

        return $stm->execute(array_values($data));
    }

    public function update(int $id, array $data) {
        
        $setFields = implode('=?, ', array_keys($data));

        $sql = "UPDATE sales SET {$setFields}=? WHERE id = {$id}";
        $stm = $this->model->db->prepare($sql);

        return $stm->execute(array_values($data));
    }

    public function delete(int $id) {
        $query   = "DELETE FROM sales WHERE id = :id";
        $prepare = $this->model->db->prepare($query);

        $prepare->bindValue(':id', $id);

        return $prepare->execute();
    }
}
