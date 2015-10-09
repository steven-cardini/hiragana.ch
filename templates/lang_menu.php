<ul class="list-inline">
  <?php
  $langs = array('de', 'en');
  foreach ($langs as $l) :
    $url = add_param($_SERVER['PHP_SELF'], 'lang', $l); ?>
    <li><a href="<?php echo $url; ?>"></a></li>
  <?php endforeach ?>
</ul>
