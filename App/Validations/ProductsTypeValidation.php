<?php

namespace App\Validations;

class ProductsTypeValidation {

    private $validations = null;

    public function makeValidation(array $data):? array {

        if (isset($data) && !empty($data)) {
            if (!isset($data['description']) || empty($data['description'])) {
                $this->validations[] = "Description is required. ";
            }

            if (!is_string($data['description'])) {
                $this->validations[] = "Description must be string. ";
            }
            
            if (!isset($data['tax_percentage']) || empty($data['tax_percentage'])) {
                $this->validations[] = "Tax Percentage type is required. ";
            }
            
            if ($this->validations !== null) {
                return [
                    "code" => 400,
                    "data" => implode(" ", $this->validations)
                ];
            }
        }

        return $this->validations;
    }
}
