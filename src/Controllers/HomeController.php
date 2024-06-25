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
    <title>API CRUD - Frontend</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<div class="container">
    <h2>Criar Usuário</h2>
    <form id="createUserForm">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit">Criar Usuário</button>
        </div>
    </form>
    <div id="createUserMessage" class="message" style="display: none;"></div>
</div>

<div class="container">
    <h2>Login de Usuário</h2>
    <form id="loginForm">
        <div class="form-group">
            <label for="loginEmail">Email:</label>
            <input type="email" id="loginEmail" name="email" required>
        </div>
        <div class="form-group">
            <label for="loginPassword">Senha:</label>
            <input type="password" id="loginPassword" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
    <div id="loginMessage" class="message" style="display: none;"></div>
</div>

<div class="container">
    <h2>Buscar Informações do Usuário</h2>
    <form id="fetchUserForm">
        <div class="form-group">
            <label for="fetchToken">Token Bearer:</label>
            <input type="text" id="fetchToken" name="token" required>
        </div>
        <div class="form-group">
            <button type="submit">Buscar Informações</button>
        </div>
    </form>
    <div id="fetchUserMessage" class="message" style="display: none;"></div>
</div>

<div class="container">
    <h2>Atualizar Informações do Usuário</h2>
    <form id="updateUserForm">
        <div class="form-group">
            <label for="updateName">Novo Nome:</label>
            <input type="text" id="updateName" name="name">
        </div>
        <div class="form-group">
            <label for="updateToken">Token Bearer:</label>
            <input type="text" id="updateToken" name="token" required>
        </div>
        <div class="form-group">
            <button type="submit">Atualizar Nome</button>
        </div>
    </form>
    <div id="updateUserMessage" class="message" style="display: none;"></div>
</div>

<div class="container">
    <h2>Deletar Usuário</h2>
    <form id="deleteUserForm">
        <div class="form-group">
            <label for="deleteUserId">ID do Usuário:</label>
            <input type="text" id="deleteUserId" name="id" required>
        </div>
        <div class="form-group">
            <label for="deleteToken">Token Bearer:</label>
            <input type="text" id="deleteToken" name="token" required>
        </div>
        <div class="form-group">
            <button type="submit">Deletar Usuário</button>
        </div>
    </form>
    <div id="deleteUserMessage" class="message" style="display: none;"></div>
</div>

<script src="scripts.js"></script>
</body>
</html>

    <?php
    }
}