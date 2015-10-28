<div class="kana-prompt-wrapper">

  <div class="kana-statistics-wrapper">
    <p id="kanaStatisticsTryNr" class="alert"></p>
    <p id="kanaStatisticsTotalNr" class="alert"></p>

    <!-- MODE SWITCH BUTTON   -->
    <button type="button" id="kanaSwitchModeButton" class="btn btn-default btn-xs">Switch Mode</button>

    <!-- RESULTS BUTTON   -->
    <form action="<?php echo ROOT_DIR; ?>kanaresults">
      <input type="submit" class="btn btn-default btn-xs" value="Results" disabled="disabled">
    </form>

  </div>


  <div class="kana-boxes-wrapper">

    <!-- PROMPT BOX   -->
    <div class="kana-box kana-prompt-box" id="kana-prompt-box">
      <p class="kana-prompt-symbol single-kana-font kana-font" id="kanaQuestionText">
        &lt;&gt;
      </p>
    </div>


    <!-- FEEDBACK BOX   -->
    <div class="kana-box kana-feedback-box">
      <p id="kana-feedback-title"></p>
      <p id="kana-feedback-your-input-title"></p>
      <p id="kana-feedback-your-input-value" class="single-kana-font"></p>
      <p id="kana-feedback-last-answer-title"></p>
      <p id="kana-feedback-last-answer-value" class="single-kana-font"></p>
    </div>


  </div>

</div>
