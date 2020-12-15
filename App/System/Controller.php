<?php

namespace App\System;

class Controller {

    public function inputGet($name = null, int $filter = FILTER_DEFAULT) {
        
        if (is_null($name)) {
            return filter_var_array($_GET, $filter);
        }

        return filter_var($_GET[$name], $filter);
    }

    public function inputPost($name = null, int $filter = FILTER_DEFAULT) {
        
        if (is_null($name)) {
            return filter_var_array($_POST, $filter);
        }

        return filter_var($_POST[$name], $filter);
    }
}