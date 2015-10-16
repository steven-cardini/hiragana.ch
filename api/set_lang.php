<?php

  $_SESSION['lang'] = $_POST['lang'];
  http_redirect($_SERVER['HTTP_REFERER']);

?>
