<?php

class DB extends mysqli {
  const HOST    = "localhost";
  const USER    = "hiragana_tech";
  const PW      = "pVqRQMKSWphPtqSu";
  const DB_NAME = "hiragana";

  private static $instance;

  private function __construct () {
    parent::__construct(self::HOST, self::USER, self::PW, self::DB_NAME);
    $this->query("SET NAMES 'utf8'");
  }

  public static function getInstance() {
    if (!self::$instance) {
      @self::$instance = new DB();
      if(self::$instance->connect_errno > 0) {
        die("Unable to connect to database [".self::$instance->connect_error."]");
      }
    }
    return self::$instance;
  }

  public static function doQuery($sql) {
    return self::getInstance()->query($sql);
  }

  public static function escapeString($str) {
    return self::getInstance()->escape_string($str);
  }


}
