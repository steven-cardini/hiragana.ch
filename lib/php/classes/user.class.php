<?php

class User {

  private $email;       // unique
  private $nickname;    // unique

  // private constructor - obejcts can be retrieved via static methods below
  private function __construct ($email, $nickname) {
    if (!$this->email) {
      $this->email = $email;
    }
    if (!$this->nickname) {
      $this->nickname = $nickname;
    }
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


  // static functions

  public static function getUserByEmail ($email) {
    $sql = "SELECT email, nickname FROM user WHERE email = '$email'";
    $res = DB::doQuery($sql);

    if ($res==null || $res->num_rows == 0) {
      return null;
    }

    return $res->fetch_object(get_class(), array('email', 'nickname'));
  }

  public static function getUserByNickname ($nickname) {
    $sql = "SELECT email, nickname FROM user WHERE nickname = '$nickname'";
    $res = DB::doQuery($sql);

    if ($res==null || $res->num_rows == 0) {
      return null;
    }

    return $res->fetch_object(get_class(), array('email', 'nickname'));
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
    FileFunctions::log("Nickname=$nickname / Email=$email / Hash=$hash / Salt=$salt / Timestamp=$timestamp");

    $sql = sprintf("INSERT INTO user
                    VALUES ('%s', '%s', '%s', '%s', '%s')",
                    $email, $nickname, $pwdData['hash'], $pwdData['salt'], $timestamp);
    $res = DB::doQuery($sql);
    if (!isset($res) || $res==null) {
      $mysqlError = mysql_error();
      FileFunctions::log("User could not be created in DB [$mysqlError]");
      return false;
    }

    return true;
  }

  public static function deleteUser ($email) {
    $sql = "DELETE FROM user WHERE email = '$email'";
    $res = DB::doQuery($sql);

    return $res != null;
  }


}
