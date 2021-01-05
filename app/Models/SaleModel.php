<?php

declare(strict_types=1);

namespace App\Models;

use App\System\Database;

class SaleModel extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "sales";
    }

    protected string $client_name;
    protected int $total_price;
    protected float $total_tax;
}
