<?php
session_start();
if(isset($_POST["nickname"]) && isset($_POST["pw"])) {
  $nickname = $_POST["nickname"];
  $pw = $_POST["pw"];
  if (Auth::checklogin($nickname, $pw))
    $_SESSION["user"] = $nickname;
}
