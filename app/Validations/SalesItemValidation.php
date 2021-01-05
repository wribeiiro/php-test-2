<?php

declare(strict_types=1);

namespace App\Validations;

class SalesItemValidation
{
    private $validations;

    public function makeValidation(): ?array
    {
        return $this->validations;
    }
}
