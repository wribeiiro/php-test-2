<?php

declare(strict_types=1);

namespace App\Models;

use App\System\Database;

class ProductTypeModel extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "products_type";
    }

    protected string $description;
    protected int $tax_percentage;
}
