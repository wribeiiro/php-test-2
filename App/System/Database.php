<?php

namespace App\System;

class Database {

    public $conn;

    public function __construct() {
        $this->setConnection();
    }

    private function setConnection() {
        try {
            $this->conn = new \PDO("mysql:host=" . DATABASE['hostname'] . ";dbname=" . DATABASE['database'], DATABASE['username'], DATABASE['password']);
            
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die($e->getCode() .  " - " .$e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
