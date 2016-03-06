<?php
  // determine which kana level to display
  $id = 0;
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
  }

 ?>

<div id="kana-select-levels">

</div>

<div id="kana-learn-wrapper">

</div>

<?php
echo '<script>';
echo 'var selectedLevel = parseInt('.json_encode($id).');';
echo '</script>';
