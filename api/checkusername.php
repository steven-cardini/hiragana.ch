<?php

$path = '../lib/php/classes/';

require_once($path.'db.class.php');
require_once($path.'user.class.php');

$nickname = htmlspecialchars($_POST['nickname']);
$nickname = DB::escapeString($nickname);

if (User::nicknameIsRegistered($nickname)) {
  echo 'true';
} else {
  echo 'false';
}
