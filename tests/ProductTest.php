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

    public function testFullDescription() {
        $this->expectException(FullDescriptionException::class);
    }

    public function testPriceIsFloat() {
        $this->assertIsFloat($this->product->getPrice());
    }

    public function testPriceIsGreatThanZero() {
        $this->assertGreaterThan(0, $this->product->getPrice());
    }
}