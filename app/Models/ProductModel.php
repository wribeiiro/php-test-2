<?php

namespace App\Models;

use App\System\Database;

class ProductModel extends Database {

    protected string $description;
    protected int $product_type_id;
    protected float $price;

    public function __construct() {
        parent::__construct();
        $this->table = "products";
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setProductType(int $productTypeId): void {
        $this->product_type_id = $productTypeId;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    public function getDescription(): string {
        return $this->description;
    } 

    public function getProductTypeId(): int {
        return $this->product_type_id;
    }

    public function getPrice(): float {
        return $this->price;
    }
}
