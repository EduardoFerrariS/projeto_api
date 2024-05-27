<?php

namespace App\Controllers;

class HomeController 
{
    public function index()
    {
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API CRUD - Exemplos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .container h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .container p {
            margin-bottom: 20px;
        }

        .container ul {
            list-style-type: none;
            padding: 0;
        }

        .container li {
            margin-bottom: 10px;
        }

        .container code {
            background-color: #f0f0f0;
            padding: 2px 5px;
            border-radius: 3px;
        }

        .container span {
            display: block;
            white-space: pre-wrap;
            font-family: monospace;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Bem-vindo! Este é um projeto  para demonstrar uma API CRUD simples.</h1>
    <p> <strong>realizado por: Eduardo Ferrari Soares - 5150796 e Matheus Cunha de Oliveira - 5156834 </strong></p>
    <p>Por favor, use os seguintes endpoints para interagir com a API:</p>
    <ul>
        <li>GET /: Para visualizar a página inicial.</li>
        <li>POST /users/create: Para criar um novo usuário.</li>
        <li>POST /users/login: Para fazer login e obter um token de autenticação.</li>
        <li>GET /users/fetch: Para buscar informações do usuário autenticado.</li>
        <li>PUT /users/update: Para atualizar informações do usuário autenticado.</li>
        <li>DELETE /users/{id}/delete: Para excluir um usuário (substitua {id} pelo ID do usuário).</li>
    </ul>

    <h2>Comandos de exemplo para uso dos endpoints:</h2>
    <ul>
        <li><code>GET /:</code> <span>curl -X GET http://localhost/api/</span></li>
        <li><code>POST /users/create:</code> <span>curl -X POST http://localhost/api/users/create -d "{\"name\":\"John\",\"email\":\"john@example.com\",\"password\":\"secret\"}" -H "Content-Type: application/json"</span></li>
        <li><code>POST /users/login:</code> <span>curl -X POST http://localhost/api/users/login -d "{\"email\":\"john@example.com\",\"password\":\"secret\"}" -H "Content-Type: application/json"</span></li>
        <li><code>GET /users/fetch:</code> <span>curl -X GET curl -X GET http://localhost/api/users/fetch -H "Authorization: Bearer <token>"</span></li>
        <li><code>PUT /users/update:</code> <span>curl -X PUT http://localhost/api/users/update -d "{\"name\":\"John Updated\"}" -H "Content-Type: application/json" -H "Authorization: Bearer <token>"</span></li>
        <li><code>DELETE /users/{id}/delete:</code> <span>curl -X DELETE http://localhost/api/users/{id}/delete -H "Authorization: Bearer <token>"</span></li>
    </ul>
</div>

</body>
</html>

    <?php
    }
}