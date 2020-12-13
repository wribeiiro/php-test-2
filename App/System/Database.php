<?php

namespace App\System;

class Database {

    public function __construct() {
        try {
            $this->conn = new \PDO("mysql:host=" . DATABASE['hostname'] . ";dbname=" . DATABASE['database'], DATABASE['username'], DATABASE['password']);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($sql) {
        $prepare = $this->prepare($sql);

        return $this->conn->query($prepare);
    }

    private function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}
