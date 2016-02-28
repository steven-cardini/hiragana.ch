<?php
  require_once('config.php');

  $key = htmlspecialchars($_POST['key']);
  $language = htmlspecialchars($_POST['language']);

  $text = I18n::tl($key, $language);
  // throw an error if the id was not found in I18n
  if (strpos($text,'Missing translation') !== false) {
    echo '404';
  } else {
    echo $text;
  }
