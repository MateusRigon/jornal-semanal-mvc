<?php

require '../src/Controller/Register.php';
require '../src/Controller/NewsList.php';

switch ($_SERVER['PATH_INFO']) {
  case '/register':
    $controller = new Register();
    $controller->loadHTML();
    break;
  case '/home-page':
    $controller = new NewsList();
    $controller->loadHTML();
    break;
  default:
    echo 'Erro-404';
    break;
}


 ?>