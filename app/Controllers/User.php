<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class User extends Controller
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  /**
   * profile view
   */
  public function perfil()
  {
    self::render('perfil', array(
      'user' => $this->userModel->getUser(array('id' => $_SESSION['id']))
    ));
  }

  /**
   * authenticate the user
   */
  public function login($data)
  {

    $user = $this->userModel->loginUser($data);

    // insert data
    if ($user) {
      // success get data
      $_SESSION['user'] = true;
      $_SESSION['name'] = $user['0']->name;
      $_SESSION['id'] = $user['0']->id;

      header('location:' . URL . 'painel');
    } else {
      // error
      header('location:' . URL . '?login-error');
    }
  }


  /**
   * add a new user
   */
  public function add($data)
  {
    if ($this->userModel->addUser($data)) {
      // success insert data
      header('location:'. URL . '?success');
    } else {
      // error
      header('location:'. URL . '?cadastro-error');
    }
  }

  /**
   * update a user
   */
  public function update($data)
  {
    $nome = self::getImage($_FILES['image']);

    $this->userModel->updateUser($nome);
    
  }
}
