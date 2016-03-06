<?php

  $api_call = true;
  require_once('../lib/php/constants.php');
  require_once('../lib/php/classloader.php');
  spl_autoload_register('loadClass');
