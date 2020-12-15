<?php 

namespace App\Helpers;

class View {

    /**
     * Includes a view
     *
     * @param string $viewName
     * @param array $options
     * @return string|null
     */
    public static function include(string $viewName, array $data = []) {

        extract($data);

        $file = dirname(__FILE__, 2)."/Views/{$viewName}.php";

        if (!file_exists($file)) {
            die("View {$file} file not exists");
        }

        require $file;
    }
}