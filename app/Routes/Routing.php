<?php

namespace App\Routes;

use CoffeeCode\Router\Router;

class Routing
{
  public $router;

  public function __construct()
  {
    $this->router = new Router(URL);
    $this->router->namespace('App\Controllers');

    // home
    $this->router->get('/', 'Main:index');
    $this->router->get('/exit', 'Main:exit');

    // painel
    $this->router->get('/painel', 'Painel:painel');
    $this->router->get('/accept/{id}', 'Painel:accept');
    $this->router->get('/recuse/{id}', 'Painel:recuse');
    $this->router->post('/invite', 'Painel:invite');
    $this->router->post('/cards', 'Painel:cardsAdd');
    $this->router->get('/cards/{id}', 'Painel:cardsStatus');

    // user
    $this->router->post('/login', 'User:login');
    $this->router->post('/cadastro', 'User:add');
    $this->router->get('/perfil', 'User:perfil');
    $this->router->post('/perfil', 'User:update');

    // route erros
    $this->router->get('/error', 'Main:error');

    $this->router->dispatch();

    // erros
    if ($this->router->error()) {
      $this->router->redirect('/error');
    }
  }
}
