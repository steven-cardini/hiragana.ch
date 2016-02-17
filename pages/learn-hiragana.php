<?php
  // determine which hiragana level to display
  $id = 0;
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
  }

 ?>

<h1>Hiragana lernen</h1>

<p>
  Teasdjfklsdjfklsdjfklsdjfksj
</p>

<div id="kana-select-levels">

</div>

<div id="kana-learn-wrapper">

</div>

<?php
echo '<script>';
echo 'var selectedLevel = parseInt('.json_encode($id).');';
echo '</script>';
