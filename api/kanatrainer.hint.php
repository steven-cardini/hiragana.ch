<?php
  require_once('config.php');

  $area = htmlspecialchars($_POST['area']);
  $name = htmlspecialchars($_POST['name']);
  $type = htmlspecialchars($_POST['type']);

  // show mnemonic picture
  if ($type == "image") {
    $path = "japanese/$area/$name.jpg";
    if(file_exists(IMG_DIR.$path)) {
      echo '<img src="'.ROOT_DIR.'img/'.$path.'" width="200">';
    } else {
      echo '404';
    }

  // show text associated with mnemonic picture
  } elseif ($type == "text") {
    $path = LIB_DIR."txt/$area.mnemonics.txt";
    if (file_exists($path)) {
      echo FileFunctions::getFileContent($path, $name);
    } else {
      echo '404';
    }
  }
