<?php

class Auth {

  public static function isLoggedIn () {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
  }

  public static function isAdmin () {
    return self::isLoggedIn() && $_SESSION['user']->isAdmin();
  }

  // used by Login page
  public static function checkLogin ($email, $password) {

    $sql = sprintf("SELECT * FROM user WHERE email='%s'",
                    $email);
    $res = DB::doQuery($sql);
    if ($res==null || $res->num_rows == 0) {
      return false;
    }

    $row = $res->fetch_assoc();
    $hash = $row['pwd_hash'];
    $salt = $row['pwd_salt'];

    if (self::getHash($password,$salt)===$hash) {
      return true;
    } else {
      return false;
    }

  }

  // only used by User class
  public static function createLogin ($password) {
    $salt = self::createSalt();
    $hash = self::getHash($password, $salt);

    $res = array();
    $res['salt']=$salt;
    $res['hash']=$hash;
    return $res;
  }

  private static function getHash ($password, $salt) {
    return hash('ripemd128', $password.$salt);
  }

  private static function createSalt () {
    return bin2hex(openssl_random_pseudo_bytes(8));
  }
}
