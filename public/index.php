<?php
include 'views/partials/header.php';

require_once 'controllers/AuthController.php';
require_once 'controllers/ContactController.php';

// Inicializar controladores
$authController = new AuthController();
$contactController = new ContactController();

// Obter a URI da requisição
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Roteamento
switch (true) {
    // Rotas de Autenticação
    case $uri === '/login':
        $authController->login();
        break;
    case $uri === '/logout':
        $authController->logout();
        break;
    case $uri === '/register':
        $authController->register();
        break;
    case $uri === '/auth/store':
        $authController->store();
        break;

    // Rotas de Contatos
    case $uri === '/contacts':
        $contactController->index();
        break;
    case $uri === '/contacts/create':
        $contactController->create();
        break;
    case $uri === '/contacts/store':
        $contactController->store();
        break;

    // Rotas com ID dinâmico
    case preg_match('/\/contacts\/show\/(\d+)/', $uri, $matches):
        $contactController->show($matches[1]);
        break;
    case preg_match('/\/contacts\/edit\/(\d+)/', $uri, $matches):
        $contactController->edit($matches[1]);
        break;
    case preg_match('/\/contacts\/update\/(\d+)/', $uri, $matches):
        $contactController->update($matches[1]);
        break;
    case preg_match('/\/contacts\/destroy\/(\d+)/', $uri, $matches):
        $contactController->destroy($matches[1]);
        break;

    // Rota de Pesquisa
    case $uri === '/contacts/search':
        $contactController->search();
        break;

    // Rota padrão (home)
    default:
        header("Location: /contacts");
        exit();
}