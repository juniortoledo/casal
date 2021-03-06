<?php

namespace App\Core;

use League\Plates\Engine;
use ReallySimpleJWT\Token;

class Controller
{
  /**
   * render views
   */
  public function render($page, $array = [])
  {
    if ($array) {
      $view = new Engine('app/views');
      echo $view->render($page, $array);
    } else {
      $view = new Engine('app/views');
      echo $view->render($page);
    }
  }

  /**
   * check if user is logged in
   */
  public function isAuth($sessionName, $url)
  {
    !$_SESSION[$sessionName] ? header('location:' . $url) : '';
  }

  /**
   * image upload
   */
  public function getImage($data)
  {
    $extension = strtolower(substr($data['name'], -5)); // file extension
    $new_name = md5(time()) . $extension; // define the file name
    $directory = ASSETS . "images/"; // defines the directory where we will send the file

    move_uploaded_file($data['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . '/assets/images/' . $new_name); // upload

    return $new_name;
  }

  /**
   * delete the file
   */
  public function deleteImage($name)
  {
    unlink(ASSETS . 'images' . '/' . $name);
  }

  /**
   * receive json
   */
  public function response($data)
  {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    return $data;
  }

  /**
   * to send json
   */
  public function send($array, $httpCode)
  {
    http_response_code($httpCode);

    echo json_encode($array);
  }
}
