<?php

namespace App\System;

use App\System\Database;

class Model {

    protected $db;
    protected $table;

    public function __construct(string $tableName) {
        $this->db    = new Database();
        $this->table = $tableName;
    }
}
