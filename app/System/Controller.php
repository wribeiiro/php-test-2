<?php

declare(strict_types=1);

namespace App\System;

class Controller
{
    protected array $response;

    public function inputGet($name = null, int $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    {
        if ($name === null) {
            return filter_var_array($_GET, $filter);
        }

        return filter_var($_GET[$name], $filter);
    }

    public function inputPost($name = null, int $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    {
        if ($name === null) {
            return filter_var_array($_POST, $filter);
        }

        return filter_var($_POST[$name], $filter);
    }

    public function inputJSON($name = null, int $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    {
        $rawData = json_decode(\file_get_contents("php://input"), true);
        
        if ($name === null) {
            return filter_var_array($rawData, $filter);
        }

        return filter_var($rawData[$name], $filter);
    }
}
