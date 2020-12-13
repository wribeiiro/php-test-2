<?php

namespace App\Models;

use App\System\Model;

class HomeModel extends Model {

    public function __construct() {
        parent::__construct('crud');
    }

    public function get(int $id = 0) {
        $query = "SELECT * FROM {this->table}";
        
        if ($id > 0) {
            $query .= " WHERE id = {$id} LIMIT 1";

            return $this->db->query($query)->fetch();
        }

        return $this->db->query($query)->fetchAll();
    }

    public function insert(array $data) {

        $query   = "INSERT INTO {$this->table} (campo) VALUES (value) ";
        $prepare = $this->db->prepare($query);

        $prepare->bindValue(':nome', $data['nome']);

        return $prepare->execute();
    }

    public function update(int $id, array $data) {

        $query   = "UPDATE {$this->table} SET WHERE  id=:id ";
        $prepare = $this->db->prepare($query);

        $prepare->bindValue(':id', $id);
        
        return $prepare->execute();
    }

    public function delete(int $id) {
        $query   = "DELETE FROM {$this->table} WHERE id = :id";
        $prepare = $this->db->prepare($query);

        $prepare->bindValue(':id', $id);

        return $prepare->execute();
    }

}
