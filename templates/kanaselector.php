<p>
  <?php echo I18n::t('kanaselector.text'); ?>
</p>
<form role="form" method="post" action="<?php echo ROOT_DIR.'kanatrainer'; ?>" id="kanaSelectForm">
  <button type="button" id="kanaSelectFormSelectAll" class="btn btn-default"><?php echo I18n::t('button.selectall'); ?></button>
  <button type="button" id="kanaSelectFormDeselectAll" class="btn btn-default"><?php echo I18n::t('button.deselectall'); ?></button>
  <label class="kana-selector-label"><input type="checkbox" id="kanaMultipleChoiceCheckbox">Multiple Choice</label>
  <input type="submit" class="btn btn-success" value="Start" name="sent">
  <div id="kanaSelectLevels"></div>
</form>

<?php

// additional content is added dynamically by kanatrainer/kanaselector.pagecontrol.js
