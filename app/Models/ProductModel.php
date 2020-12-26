<?php

namespace App\Models;

use App\System\Database;

class ProductModel extends Database {

    /**
     * @property string $description
     */
    protected string $description;

    /**
     * @property int $product_type_id
     */
    protected int $product_type_id;

    /**
     * @property float $description
     */
    protected float $price;

    public function __construct() {
        parent::__construct();
        $this->table = "products";
    }

    /**
     * setDescription
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * setProductType
     *
     * @param integer $productTypeId
     * @return void
     */
    public function setProductType(int $productTypeId): void {
        $this->product_type_id = $productTypeId;
    }

    /**
     * setPrice
     *
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void {
        $this->price = $price;
    }

    /**
     * getDescription
     *
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    } 

    /**
     * getProductTypeId
     *
     * @return integer
     */
    public function getProductTypeId(): int {
        return $this->product_type_id;
    }

    /**
     * getPrice
     *
     * @return float
     */
    public function getPrice(): float {
        return $this->price;
    }
}
