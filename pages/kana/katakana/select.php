<h1>Katakana Trainer</h1>

<?php

require_once(KANA_DIR.'kanaselector.php');

echo '<!-- set localized variables for kanaselector.controller.js -->
<script>
  var error_no_symbols = '.json_encode(I18n::t('kanatrainer.err.no-symbols')).'
</script>';
