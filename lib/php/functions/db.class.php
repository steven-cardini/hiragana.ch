<?php
// require separate php file with definitions of DB_HOST, DB_USER, DB_PW and DB_NAME
// e.g. define ("DB_HOST", "localhost");
//      define ("DB_USER", "my_user");
//      define ("DB_PW", "password");
//      define ("DB_NAME", "my_db");
require_once FUNCTIONS_DIR.'db.const.php';

class DB extends mysqli {
  private static $instance;

  private function __construct () {
    parent::__construct(DB_HOST, DB_USER, DB_PW, DB_NAME);
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
