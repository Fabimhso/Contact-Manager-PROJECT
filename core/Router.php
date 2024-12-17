<?php
require_once '../app/controllers/AuthController.php';

$uri = $_SERVER['REQUEST_URI'];

$auth = new AuthController();

switch ($uri) {
    case '/register':
        $auth->register();
        break;
    case '/login':
        $auth->login();
        break;
    case '/logout':
        $auth->logout();
        break;
    default:
        echo "404 - Página não encontrada";
        break;
}

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/ContactController.php';

$uri = explode('?', $_SERVER['REQUEST_URI'])[0];

$auth = new AuthController();
$contact = new ContactController();

switch ($uri) {
    case '/register':
        $auth->register();
        break;
    case '/login':
        $auth->login();
        break;
    case '/logout':
        $auth->logout();
        break;
    case '/contacts':
        $contact->list();
        break;
    case '/contacts/create':
        $contact->create();
        break;
    case '/contacts/search':
        $contact->search();
        break;
    case (preg_match('/\/contacts\/delete\/(\d+)/', $uri, $matches) ? true : false):
        $contact->delete($matches[1]);
        break;
    default:
        echo "404 - Página não encontrada";
        break;
}