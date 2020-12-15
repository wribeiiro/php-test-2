<?php 

namespace App\Helpers;

class Util {
    
    /**
     * response json
     *
     * @param array $array
     * @return void
     */
    public static function response(array $array, int $code = 200): void {
        http_response_code($code);
		header("Content-Type: application/json");
		echo json_encode($array);
		exit;
    }
    
    /**
     * Includes a view
     *
     * @param string $viewName
     * @param array $options
     * @return string|null
     */
    public static function view(string $viewName, array $data = []) {

        extract($data);

        $file = dirname(__FILE__, 2)."/Views/{$viewName}.php";

        if (!file_exists($file)) {
            die("View {$file} file not exists");
        }

        require $file;
    }
}