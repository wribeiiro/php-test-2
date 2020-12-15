<?php

namespace App\Validations;

use App\Helpers\Response;

class SalesItemValidation {

    private $validations = null;

    public function makeValidation(array $data):? array {
        return $this->validations;
    }
}
