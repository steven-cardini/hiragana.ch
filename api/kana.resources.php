<?php
  require_once('config.php');

  $area = htmlspecialchars($_POST['area']);
  $symbol = htmlspecialchars($_POST['symbol']);
  $type = htmlspecialchars($_POST['type']);
  $language = htmlspecialchars($_POST['language']);

  // show mnemonic picture
  if ($type == "image.mnemonic") {
    $path = "japanese/$area/$symbol.jpg";
    if(file_exists(IMG_DIR.$path)) {
      echo '<img src="'.ROOT_DIR.'img/'.$path.'" width="200">';
    } else {
      echo '404';
    }

  // show lead text associated with mnemonic picture
} elseif ($type == "text.lead") {
    $key = "$area.learn.$symbol.lead";
    $text = I18n::tl($key, $language);
    // throw an error if the id was not found in I18n
    if (strpos($text,'Missing translation') === false) {
      echo $text;
    } else {
      echo '404';
    }
  }
