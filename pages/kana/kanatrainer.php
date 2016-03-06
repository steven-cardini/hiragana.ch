<div class="kana-prompt-wrapper">

  <div class="kana-statistics-wrapper">

    <!-- MODE SWITCH BUTTON   -->
    <button id="kana-switch-mode-button" class="btn btn-default btn-xs"><?php echo I18n::t('button.switchmode'); ?></button>

    <!-- RESULTS BUTTON   -->
    <button id="kana-results-button"  class="btn btn-default btn-xs"><?php echo I18n::t('button.results'); ?></button>

    <!-- RESET BUTTON -->
    <button id="kana-reset-button" class="btn btn-danger btn-xs"><?php echo I18n::t('button.reset'); ?></button>

  </div>


  <div class="kana-boxes-wrapper">

    <!-- PROMPT BOX   -->
    <div class="kana-box kana-prompt-box" id="kana-prompt-box">
      <table width="100%">
        <col width="50%">
        <col width="50%">
        <tr>
          <td>
            <?php echo I18n::t('kanatrainer.try'); ?>
          </td>
          <td>
            <?php echo I18n::t('kanatrainer.correct'); ?>
          </td>
        </tr>
        <tr>
          <td id="kanaStatisticsTryNr">
            &nbsp;
          </td>
          <td id="kanaStatisticsCorrectNr">
            &nbsp;
          </td>
        </tr>
      </table>
      <hr>
      <p class="kana-prompt-symbol single-kana-font" id="kanaQuestionText">
        &lt;&gt;
      </p>
    </div>

    <!-- FEEDBACK BOX   -->
    <div class="kana-box kana-feedback-box">
      <div class="alert-danger" id="kana-feedback-title">WRONG</div>
      <div class="kana-feedback-symbol">Symbol</div>
      <div class="kana-feedback-symbol lead">か</div>
      <div class="kana-feedback-user-input"><?php echo I18n::t('kanatrainer.youranswer'); ?></div>
      <div class="kana-feedback-user-input lead">sa</div>
      <div class="kana-feedback-correct-input"><?php echo I18n::t('kanatrainer.correctanswer'); ?></div>
      <div class="kana-feedback-correct-input lead">ka</div>
    </div>

    <!-- HINT BOX -->
    <div class="kana-box kana-hint-box">
      <div class="kana-hint-title"><strong><?php echo I18n::t('kanatrainer.hint'); ?></strong></div>
      <div class="kana-hint-text alert alert-warning"></div>
      <div class="kana-hint-image"></div>
    </div>

  </div>

</div>

<!-- set localized variables for kanatrainer.controller.js -->
<?php
echo '<script>
  var text_wrong = '.json_encode(strtoupper(I18n::t('kanatrainer.wrong'))).';
  var text_correct = '.json_encode(strtoupper(I18n::t('kanatrainer.correct'))).';
  var error_no_symbols = '.json_encode(I18n::t('kanatrainer.err.no-symbols')).'
  var error_mc_switch = '.json_encode(I18n::t('kanatrainer.err.mc-switch')).';
</script>';
