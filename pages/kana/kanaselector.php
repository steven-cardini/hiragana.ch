<p>
  <?php echo I18n::t('kanaselector.text'); ?>
</p>
<form role="form" method="post" action="" id="kana-select-form">
  <button type="button" id="kana-select-form-select-all" class="btn btn-default"><?php echo I18n::t('button.selectall'); ?></button>
  <button type="button" id="kana-select-form-deselect-all" class="btn btn-default"><?php echo I18n::t('button.deselectall'); ?></button>
  <label class="kana-selector-label"><input type="checkbox" id="kana-multiple-choice-checkbox">Multiple Choice</label>
  <input type="submit" class="btn btn-success" value="Start" name="sent">
  <div id="kana-select-levels"></div>
</form>

<?php

// additional content is added dynamically by kanatrainer/kanaselector.pagecontrol.js
