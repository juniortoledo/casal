<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PainelModel;

class Painel extends Controller
{
  private $painelModel;

  public function __construct()
  {
    $this->painelModel = new PainelModel();
  }

  /**
   * view painel
   */
  public function painel()
  {
    self::isAuth('user', URL);

    $cards = $this->painelModel->getCards(array('id' => $_SESSION['id']));
    $users = $this->painelModel->getUsers();

    // render view
    self::render('painel', array(
      'pairs' => $this->painelModel->getPairs(array('id' => $_SESSION['id'])),
      'cards' => $cards,
      'users' => $users,
      'invitationsPrimary' => $this->painelModel->getInvitationsPrimary(array('id' => $_SESSION['id'])),
      'invitationsSecondary' => $this->painelModel->getInvitationsSecondary(array('id' => $_SESSION['id']))
    ));
  }

  /**
   * invite pair
   */
  public function invite($data)
  {
    if ($this->painelModel->sendInvitation($data)) {
      header('location:' . URL . 'painel');
    } else {
      header('location:' . URL . 'painel?invite-error');
    }
  }

  /**
   * accept invite
   */
  public function accept($data)
  {
    $this->painelModel->acceptInvite($data);
    header('location:' . URL . 'painel');
  }

  /**
   * recuse invite
   */
  public function recuse($data)
  {
    $this->painelModel->recuseInvite($data);
    header('location:' . URL . 'painel');
  }

  /**
   * add cards
   */
  public function cardsAdd($data)
  {
    $this->painelModel->addCard($data);
    header('location:' . URL . 'painel');
  }

  /**
   * cards status
   */
  public function cardsStatus($data)
  {
    $this->painelModel->statusCards($data);
    header('location:' . URL . 'painel');
  }
}
