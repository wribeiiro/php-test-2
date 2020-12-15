<?php

namespace App\Validations;

use App\Helpers\Response;
class SalesValidation {

    private $validations = null;

    public function makeValidation(array $data):? array {
        
        if (isset($data) && !empty($data)) {

            if (!isset($data['client_name']) || empty($data['client_name'])) {
                $this->validations[] = "Client Name is required. ";
            }

            if (!is_string($data['client_name'])) {
                $this->validations[] = "Client Name must be string. ";
            }
            
            if (!isset($data['total_price']) || empty($data['total_price'])) {
                $this->validations[] = "Price is required. ";
            }

            if (filter_var($data['total_price'], FILTER_VALIDATE_FLOAT) === false) {
                $this->validations[] = "Price must be float. ";
            }

            if (!isset($data['total_tax']) || empty($data['total_tax'])) {
                $this->validations[] = "Tax is required. ";
            }

            if (filter_var($data['total_tax'], FILTER_VALIDATE_FLOAT) === false) {
                $this->validations[] = "Tax must be float. ";
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
