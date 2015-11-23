<div class="kana-prompt-wrapper">

  <div class="kana-statistics-wrapper">

    <!-- MODE SWITCH BUTTON   -->
    <button type="button" id="kanaSwitchModeButton" class="btn btn-default btn-xs">Switch Mode</button>

    <!-- RESULTS BUTTON   -->
    <button type="submit" id="kanaResultsButton"  class="btn btn-default btn-xs">Results</button>

  </div>


  <div class="kana-boxes-wrapper">

    <!-- PROMPT BOX   -->
    <div class="kana-box kana-prompt-box" id="kana-prompt-box">
      <table width="100%">
        <col width="50%">
        <col width="50%">
        <tr>
          <td>
            Try
          </td>
          <td>
            Correct
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
      <p class="kana-prompt-symbol single-kana-font kana-font" id="kanaQuestionText">
        &lt;&gt;
      </p>
    </div>

    <!-- FEEDBACK BOX   -->
    <div class="kana-box kana-feedback-box">
      <div class="alert-danger" id="kana-feedback-title">WRONG</div>
      <div class="kana-feedback-symbol">Symbol</div>
      <div class="kana-feedback-symbol lead">か</div>
      <div class="kana-feedback-user-input">Your answer</div>
      <div class="kana-feedback-user-input lead">sa</div>
      <div class="kana-feedback-correct-input">Correct answer</div>
      <div class="kana-feedback-correct-input lead">ka</div>
    </div>

    <!-- HINT BOX -->
    <div class="kana-box kana-hint-box">
      <div class="kana-hint-title"><strong>Hint</strong></div>
      <div class="kana-hint-image"></div>
    </div>

  </div>

</div>
