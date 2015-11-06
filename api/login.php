<?php
session_start();
// include all relevant PHP files
require_once('../lib/php/classes/db.class.php');
require_once('../lib/php/classes/auth.class.php');
require_once('../lib/php/classes/user.class.php');

require_once('../lib/php/classes/filefunctions.class.php');

if(isset($_POST["email"]) && isset($_POST["pw"])) {
  $email = htmlspecialchars($_POST["email"]);
  $email = DB::escapeString($email);
  $pw = $_POST["pw"];
  if (Auth::checklogin($email, $pw)) {
    $_SESSION['user'] = User::getUserByEmail($email);
    FileFunctions::log("User logged in successfully.");
  } else {
    FileFunctions::log("Login failed");
  }
}

header("location:../index.php");
