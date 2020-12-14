<?php

namespace App\Models;

use App\System\Model;

class SaleModel extends Model {

    protected string $client_name;
    protected int $total_price;
    protected float $total_tax;
}
