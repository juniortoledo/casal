<?php

namespace App\Controllers;

use App\Core\Controller;

class Main extends Controller
{
  /**
   * view index
   */
  public function index()
  {
    // render view
    self::render('index');
  }

  /**
   * destroi sessions
   */
  public function exit()
  {
    session_destroy();
    header('location:' . URL);
  }

  /**
   * view error
   */
  public function error()
  {
    // render error
    self::render('error');
  }
}
