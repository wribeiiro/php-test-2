<?php 

namespace App\Helpers;

class Response {
    
    // Success
    const HTTP_OK                    = 200;
    const HTTP_CREATED               = 201;
    const HTTP_NO_CONTENT            = 204;

    // Client Error
    const HTTP_BAD_REQUEST           = 400;
    const HTTP_UNAUTHORIZED          = 401;

    // Server Error
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    
    /**
     * response json
     *
     * @param array $array
     * @return void
     */
    public static function respond(array $array, int $code = self::HTTP_OK): void {
        http_response_code($code);
		header("Content-Type: application/json");
		echo json_encode($array);
		exit;
    }
}