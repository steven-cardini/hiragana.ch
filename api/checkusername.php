<?php

require_once('config.php');

$nickname = htmlspecialchars($_POST['nickname']);
$nickname = DB::escapeString($nickname);

if (User::nicknameIsRegistered($nickname)) {
  echo 'true';
} else {
  echo 'false';
}
