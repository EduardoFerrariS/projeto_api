<?php 

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class NotFoundController
{
    public function index(Request $request, Response $response)
    {
        $response::json([
            'error'   => true,
            'success' => false,
            'message' => ' Rota não  encontrada.'
        ], 404);
        return;
    }
}