<?php

namespace App\System;

use CoffeeCode\Router;

class Controller {

    /**
     * @var Router
     */
    protected $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function inputGet(int $filter = 0) {
        
        if ($filter > 0) {
            return filter_var_array($_GET, $filter);
        }

        return $_GET;
    }

    public function inputPost(int $filter = 0) {
        
        if ($filter > 0) {
            return filter_var_array($_POST, $filter);
        }

        return $_POST;
    }
}