<?php

namespace App\Repositories;

use App\Models\SaleModel;

class SalesRepository {

    private $model;

    public function __construct() {
        $this->model = new SaleModel(); 
    }
    
    public function get(int $id = 0) {
        $query = "SELECT * FROM {this->table}";
        
        if ($id > 0) {
            $query .= " WHERE id = {$id} LIMIT 1";

            return $this->model->db->query($query)->fetch();
        }

        return $this->model->db->query($query)->fetchAll();
    }

    public function create(array $data) {

        $query   = "INSERT INTO {$this->table} (campo) VALUES (value) ";
        $prepare = $this->model->db->prepare($query);

        $prepare->bindValue(':nome', $data['nome']);

        return $prepare->execute();
    }

    public function update(int $id, array $data) {

        $query   = "UPDATE {$this->table} SET WHERE  id=:id ";
        $prepare = $this->model->db->prepare($query);

        $prepare->bindValue(':id', $id);
        
        return $prepare->execute();
    }

    public function delete(int $id) {
        $query   = "DELETE FROM {$this->table} WHERE id = :id";
        $prepare = $this->model->db->prepare($query);

        $prepare->bindValue(':id', $id);

        return $prepare->execute();
    }
}
