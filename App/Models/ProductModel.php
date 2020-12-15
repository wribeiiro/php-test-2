<?php

namespace App\Models;

use App\System\Database;

class ProductModel extends Database {

    public function __construct()
    {
        parent::__construct();
        $this->table = "products";
    }

    protected string $description;
    protected int $product_type_id;
    protected float $price;

}
