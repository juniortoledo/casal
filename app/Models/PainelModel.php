<?php

namespace App\Models;

use App\Core\CrudModel;

class PainelModel extends CrudModel
{
  /**
   * get pair
   */
  public function getPairs($data)
  {
    $primary = self::get('pairs', 'idPrimary', $data['id']);
    $secondary = self::get('pairs', 'idSecondary', $data['id']);

    if ($primary || $secondary) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * get cards
   */
  public function getCards($data)
  {
    $primary = self::get('cards', 'idPrimary', $data['id']);
    $secondary = self::get('cards', 'idSecondary', $data['id']);

    if ($primary) {
      return array_merge($primary, $secondary);
    } elseif ($secondary) {
      return array_merge($secondary, $primary);
    } else {
      return false;
    }
  }

  /**
   * status cards
   */
  public function statusCards($data)
  {
    $cardStatus = self::get('cards', 'id', $data['id']);

    foreach ($cardStatus as $item) {
      if ($item->status === 0) {
        self::update(array('status' => 1), 'cards', $data['id']);
      } else {
        self::update(array('status' => 0), 'cards', $data['id']);
      }
    }
  }

  /**
   * add card
   */
  public function addCard($data)
  {
    $primary = self::get('pairs', 'idPrimary', $_SESSION['id']);
    $secondary = self::get('pairs', 'idSecondary', $_SESSION['id']);

    if ($primary) {
      foreach ($primary as $item) {
        self::insert(array(
          'status' => 0,
          'idPrimary' => $_SESSION['id'],
          'idSecondary' => $item->idSecondary,
          'namePrimary' => $item->namePrimary,
          'nameSecondary' => $item->nameSecondary,
          'title' => $data['title'],
          'autor' => $item->namePrimary,
          'description' => $data['description'],
          'date' => $data['date'],
          'created_at' => date('d-m-Y')
        ), 'cards');
      }
    } else {
      foreach ($secondary as $item) {
        self::insert(array(
          'status' => 0,
          'idPrimary' => $_SESSION['id'],
          'idSecondary' => $item->idPrimary,
          'namePrimary' => $item->nameSecondary,
          'nameSecondary' => $item->namePrimary,
          'title' => $data['title'],
          'autor' => $item->nameSecondary,
          'description' => $data['description'],
          'date' => $data['date'],
          'created_at' => date('d-m-Y')
        ), 'cards');
      }
    }
  }

  /**
   * set card status
   */
  public function cardStatus($data)
  {
    return self::update(array(
      'status' => 0,
    ), 'cards', $data['id']);
  }

  /**
   * delete cards
   */
  public function deleteCards($data)
  {
    // delete invite
    return self::delete('cards', $data['id']);
  }

  /**
   * get invitations
   */
  public function getInvitationsPrimary($data)
  {
    return self::get('invitations', 'idPrimary', $data['id']);
  }

  /**
   * get invitations
   */
  public function getInvitationsSecondary($data)
  {
    return self::get('invitations', 'idSecondary', $data['id']);
  }

  /**
   * send invitation
   */
  public function sendInvitation($data)
  {
    $user = self::get('users', 'email', $data['email']);

    // check if exist the email
    if ($user) {
      return self::insert(array(
        'status' => 0,
        'idPrimary' => $data['id'],
        'idSecondary' => $user['0']->id,
        'namePrimary' => $data['name'],
        'nameSecondary' => $user['0']->name,
      ), 'invitations');
    } else {
      // not existi the email
      return false;
    }
  }

  /**
   * accept invite
   */
  public function acceptInvite($data)
  {
    foreach (self::get('invitations', 'id', $data['id']) as $item) {
      // add pair
      $add =  self::insert(array(
        'idPrimary' => $item->idPrimary,
        'idSecondary' => $item->idSecondary,
        'namePrimary' => $item->namePrimary,
        'nameSecondary' => $item->nameSecondary,
        'status' => 0
      ), 'pairs');

      // delete invite
      self::recuseInvite($data);

      return $add;
    }
  }

  /**
   * recuse invite
   */
  public function recuseInvite($data)
  {
    // delete invite
    return self::delete('invitations', $data['id']);
  }

  /**
   * get all users
   */
  public function getUsers()
  {
    return self::getAll('users');
  }
}
