<?php
  define ("ROOT_DIR", "/hiragana.ch/");
  $area = $_GET['area'];
  $name = $_GET['name'];

  $path = "img/japanese/".$area."/".$name.".jpg";

  if(file_exists("../../".$path)) {
    echo '<img src="'.ROOT_DIR.$path.'" width="200">';
  }
  else {
    echo '404';
  }
