<?php 

namespace App\Http;

class Request
{
    public static function method()
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    public static function body()
    {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        $data = match(self::method()) {
            'GET' => $_GET,
            'POST', 'PUT', 'DELETE' => $json,
        };

        return $data;
    }

    public static function authorization()
    {
        $authorization = getallheaders();

        if (!isset($authorization['Authorization'])) return ['error' => 'nenhum token de autorização fornecido'];

        $authorizationPartials = explode(' ', $authorization['Authorization']);

        if (count($authorizationPartials) != 2) return ['error'=> 'Forneça um token de autorização válido.'];

        return $authorizationPartials[1] ?? '';
    }
}