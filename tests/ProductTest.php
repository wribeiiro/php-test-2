<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\Models\ProductModel;

class ProductTest extends TestCase {

    /**
     * @var ProductModel
     */
    private $product;

    protected function setUp(): void {
        $this->product = new ProductModel();

        $this->product->setDescription('Product Test');
        $this->product->setProductType(0);
        $this->product->setPrice(5.25);
    }

    /**
     * @covers App\Models\ProductModel
     */
    public function testFullDescription() {
        $this->assertCount(2, explode(' ' ,$this->product->getDescription()));
    }

    /**
     * @covers App\Models\ProductModel
     */
    public function testPriceIsFloat() {
        $this->assertIsFloat($this->product->getPrice());
    }

    /**
     * @covers App\Models\ProductModel
     */
    public function testPriceIsGreatThanZero() {
        $this->assertGreaterThan(0, $this->product->getPrice());
    }

    /**
     * @covers App\Models\ProductModel
     */
    public function testPriceLengthIsLessThanNine() {
        $this->assertLessThanOrEqual(9, strlen($this->product->getPrice()));
    }
}