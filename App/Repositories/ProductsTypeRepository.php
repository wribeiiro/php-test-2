<?php

namespace App\Repositories;

use App\Models\ProductModel;

class ProductsTypeRepository {

    private $model;

    public function __construct() {
        $this->model = new ProductModel(); 
    }
    
    public function get() {
        $sql = "SELECT * FROM products_type ORDER BY description DESC";
        
        return $this->model->db->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public function create(array $data) {
        
        $fields = array_keys($data);
        $binds  = array_pad([], count($fields),'?');

        $sql = 'INSERT INTO products_type ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';
        $stm = $this->model->db->prepare($sql);

        return $stm->execute(array_values($data));
    }

    public function update(int $id, array $data) {
        
        $setFields = implode('=?, ', array_keys($data));

        $sql = "UPDATE products_type SET {$setFields}=? WHERE id = {$id}";
        $stm = $this->model->db->prepare($sql);

        return $stm->execute(array_values($data));
    }

    public function delete(int $id) {
        $query   = "DELETE FROM products_type WHERE id = :id";
        $prepare = $this->model->db->prepare($query);

        $prepare->bindValue(':id', $id);

        return $prepare->execute();
    }
}
