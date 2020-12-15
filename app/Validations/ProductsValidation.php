<?php

namespace App\Validations;
use App\Helpers\Response;
class ProductsValidation {

    private $validations = null;

    public function makeValidation(array $data):? array {

        if (isset($data) && !empty($data)) {
            
            if (!isset($data['description']) || empty($data['description'])) {
                $this->validations[] = "Description is required. ";
            }

            if (!is_string($data['description'])) {
                $this->validations[] = "Description must be string. ";
            }
            
            if (!isset($data['product_type_id']) || empty($data['product_type_id'])) {
                $this->validations[] = "Product type is required. ";
            }

            if (filter_var($data['product_type_id'], FILTER_VALIDATE_INT) === false) {
                $this->validations[] = "Product type must be integer. ";
            }
            
            if (!isset($data['price']) || empty($data['price'])) {
                $this->validations[] = "Price is required. ";
            }

            if (filter_var($data['price'], FILTER_VALIDATE_FLOAT) === false) {
                $this->validations[] = "Price must be float. ";
            }
            
            if ($this->validations !== null) {
                return [
                    "code" => Response::HTTP_BAD_REQUEST,
                    "data" => implode(" ", $this->validations)
                ];
            }
        }

        return $this->validations;
    }
}
