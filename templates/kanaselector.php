<p>
  Please choose the training levels below and click Start!
</p>
<form role="form" method="post" action="<?php echo ROOT_DIR.'kanatrainer'; ?>" id="kanaSelectForm">
  <button type="button" id="kanaSelectFormSelectAll" class="btn btn-default">Select all</button>
  <button type="button" id="kanaSelectFormDeselectAll" class="btn btn-default">Deselect all</button>
  <input type="submit" class="btn btn-default" value="Start" name="sent">
  <label><input type="checkbox" id="kanaMultipleChoiceCheckbox">Multiple Choice</label>
</form>

<?php

// additional content is added dynamically by kanatrainer/kanaselector.pagecontrol.js
