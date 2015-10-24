<div class="kana-prompt-wrapper">

  <div class="kana-boxes-wrapper">

    <!-- PROMPT BOX   -->
    <div class="kana-box kana-prompt-box" id="kana-prompt-box">
      <p class="kana-prompt-symbol single-kana-font kana-font" id="kanaQuestionText">
        &lt;&gt;
      </p>
    </div>


    <!-- FEEDBACK BOX   -->
    <div class="kana-box kana-feedback-box">
      <p id="kanaFeedbackText" class="alert"></p>
      <p id="kanaFeedbackLastAnswer" class="single-kana-font"></p>
      <p id="kanaFeedbackLastQuestion" class="h1 kana-font"></p>
    </div>

    <!-- STATISTICS BOX   -->
    <div class="kana-box kana-statistics-box">
      <p id="kanaStatisticsTryNr" class="alert"></p>
    </div>

  </div>

  <!-- MODE SWITCH BUTTON   -->
  <button type="button" id="kanaSwitchModeButton" class="btn btn-default btn-xs">Switch Mode</button>

  <!-- RESULTS BUTTON   -->
  <form action="<?php echo ROOT_DIR; ?>kanaresults">
    <input type="submit" class="btn btn-default btn-xs" value="Results" disabled="disabled">
  </form>

  <!-- BACK BUTTON   -->
  <form action="<?php echo ROOT_DIR; ?>">
    <input type="submit" class="btn btn-default btn-xs" value="Back" disabled="disabled">
  </form>

</div>
