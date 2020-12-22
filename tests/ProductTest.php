<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

    public function testPriceIsFloat() {
        $this->assertIsFloat(5.75);
    }

    public function testPriceIsNotFloat() {
        $this->assertIsNotFloat(1);
    }

    public function testPriceIsGreatThanZero() {
        $this->assertGreaterThan(0, 1);
    }

    public function testPriceIsNotGreatThanZero() {
        $this->assertGreaterThan(0, 0);
    }
}