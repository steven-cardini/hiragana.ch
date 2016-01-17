<?php

class User {

  private $email;       // unique
  private $nickname;    // unique
  private $isAdmin; // int (0 or 1)
  private $registered;  // String in timestamp format

  // private constructor - obejcts can be exclusively retrieved via static methods below
  private function __construct ($email, $nickname, $isAdmin, $registered) {
    if (!isset($this->email))
      $this->email = $email;
    if (!isset($this->nickname))
      $this->nickname = $nickname;
    if (!isset($this->isAdmin))
      $this->isAdmin = (int) $isAdmin;
    if (!isset($this->registered))
      $this->registered = $registered;
  }

  public function getEmail () {
    return $this->email;
  }

  public function getNickname () {
    return $this->nickname;
  }

  public function setNickname ($nickname) {
    $this->nickname = $nickname;

    $sql = sprintf (" UPDATE user
                      SET nickname='%s'
                      WHERE email='%s'",
                      $this->nickname, $this->email);
    $res = DB::doQuery($sql);
    return $res != null;
  }

  public function isAdmin () {
    return (bool) $this->isAdmin === true;
  }

  public function timestampRegistered () {
    return $this->registered;
  }


  // static functions

  public static function getUserByEmail ($email) {
    $sql = "SELECT email, nickname, is_admin AS isAdmin, t_registered AS registered FROM user WHERE email = '$email'";
    $res = DB::doQuery($sql);

    if ($res==null || $res->num_rows == 0) {
      return null;
    }

    return $res->fetch_object(get_class(), array('email@address.com', 'nickname', '0', date('Y-m-d H:i:s')));
  }

  public static function getUserByNickname ($nickname) {
    $sql = "SELECT email, nickname, is_admin AS isAdmin, t_registered AS registered FROM user WHERE nickname = '$nickname'";
    $res = DB::doQuery($sql);

    if ($res==null || $res->num_rows == 0) {
      return null;
    }

    return $res->fetch_object(get_class(), array('email@address.com', 'nickname', '0', date('Y-m-d H:i:s')));
  }

  public static function emailIsRegistered ($email) {
    return self::getUserByEmail($email) !== null;
  }

  public static function nicknameIsRegistered ($nickname) {
    return self::getUserByNickname($nickname) !== null;
  }

  public static function createUser ($nickname, $email, $password) {

    // create new user
    $pwdData = Auth::createLogin($password);
    $hash=$pwdData['hash'];
    $salt=$pwdData['salt'];
    $timestamp = date('Y-m-d H:i:s');

    $sql = sprintf("INSERT INTO user (email, nickname, pwd_hash, pwd_salt)
                    VALUES ('%s', '%s', '%s', '%s')",
                    $email, $nickname, $pwdData['hash'], $pwdData['salt']);
    $res = DB::doQuery($sql);
    if (!isset($res) || $res==null) {
      return false;
    }

    return true;
  }

  public static function getMultipleUsers ($amount, $offset) {
    $sql = "SELECT email, nickname, is_admin AS isAdmin, t_registered AS registered FROM user ORDER BY nickname ASC LIMIT $amount OFFSET $offset";
    $res = DB::doQuery($sql);

    if ($res==null || $res->num_rows == 0) {
      return null;
    }

    $list=array();
    while ($obj = $res->fetch_object(get_class(),array('email@address.com', 'nickname', '0', date('Y-m-d H:i:s')))) {
      $list[] = $obj;
    }

    return $list;
  }

  public static function deleteUser ($email) {
    $sql = "DELETE FROM user WHERE email = '$email'";
    $res = DB::doQuery($sql);

    return $res != null;
  }


}
