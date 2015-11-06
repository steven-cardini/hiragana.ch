<?php

class DB extends mysqli {
  const HOST    = "localhost";
  const USER    = "hiragana_tech";
  const PW      = "pVqRQMKSWphPtqSu";
  const DB_NAME = "hiragana";

  private static $instance;

  private function __construct () {
    parent::__construct(self::HOST, self::USER, self::PW, self::DB_NAME);
  }

  public static function getInstance() {
    if (!self::$instance) {
      @self::$instance = new DB();
      if(self::$instance->connect_errno > 0) {
        FileFunctions::log("Unable to connect to db");
        die("Unable to connect to database [".self::$instance->connect_error."]");
      }
    }
    return self::$instance;
  }

  public static function doQuery($sql) {
    return self::getInstance()->query($sql);
  }


}