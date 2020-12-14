<?php

namespace App\System;

use App\System\Database;

class Model {

    public $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }
}
