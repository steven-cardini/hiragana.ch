var _kanaTrainer;
var _controller;
var _playMultipleChoice;
var _userInput;

var TextInputController = function () {

  // constructor
  // remove multiple choice, add text input field and large button
  $("#kanaMultipleChoiceArea").remove();
  initializeTextInput();

  function initializeTextInput() {
    var ele = '<form role="form" method="post" action="javascript:void(0);" id="kanaAnswerForm" autocomplete="off">';
    ele += '<input type="text" id="kanaAnswerTextfield" class="form-control text-center input-lg" name="answerInput" maxlength="4" autofocus="autofocus">';
    ele += '</form>';

    $("#kana-prompt-box").append(ele);
    $("#kanaAnswerTextfield").focus();
  }

  // allow only letters [A-Za-z] in input field
  $("#kanaAnswerTextfield").keypress(function(event){
    var inputValue = event.which;
    if ( (inputValue < 65 || inputValue > 90) && (inputValue < 97 || inputValue > 122) && inputValue != 13){
      event.preventDefault();
    }
  });

  // user clicked submit button below input field
  $("#kanaAnswerTextfield").keyup(function (e) {
    if (e.keyCode != 13) { // NOT the enter key was pressed
      return;
    }

    _userInput = $("#kanaAnswerTextfield").val();

    if (typeof _userInput === undefined || _userInput === "") { // user did not enter anything
      return;
    }

    $("#kanaAnswerTextfield").val('');
    _userInput = _userInput.toLowerCase();

    if (_kanaTrainer.validate(_userInput)) {  //answer is correct
      handlePositiveFeedback();
    } else {  // answer was false
      handleNegativeFeedback();
    }
  });

}; // end TextInputController


var MultipleChoiceController = function () {

  // constructor
  // remove text input field and large button, add multiple choice
  $("#kanaAnswerForm").remove();
  initializeMultipleChoice();

  this.update = function () {
    updateMultipleChoice();
  };

  function initializeMultipleChoice () {
    var ele = '<div id="kanaMultipleChoiceArea">';
    ele += '<div class="row">';
    ele += '<div class="col-xs-6"><button type="button" class="btn btn-default btn-lg btn-block">0</button></div>';
    ele += '<div class="col-xs-6"><button type="button" class="btn btn-default btn-lg btn-block">1</button></div>';
    ele += '</div>';
    ele += '<div class="row">';
    ele += '<div class="col-xs-6"><button type="button" class="btn btn-default btn-lg btn-block">2</button></div>';
    ele += '<div class="col-xs-6"><button type="button" class="btn btn-default btn-lg btn-block">3</button></div>';
    ele += '</div>';
    ele += '</div>';

    $("#kana-prompt-box").append(ele);

    $("#kanaMultipleChoiceArea button").focus(function() {
        this.blur();
    });

    updateMultipleChoice();
  }

  function updateMultipleChoice () {
    var multipleChoice = _kanaTrainer.getMultipleChoiceOptions();
    var buttons = $("button.btn-block");
    var i = 0;
    $.each(buttons, function() {
      $(this).attr('value', multipleChoice[i]);
      $(this).html(multipleChoice[i++]);
    });
  }


  // user clicked a multiple choice button
  $('button.btn-block').click(function(){
    _userInput = $(this).attr('value');
    if (_kanaTrainer.validate(_userInput)) {  //answer is correct
      handlePositiveFeedback();
    } else {  // answer was false
      handleNegativeFeedback();
    }
  });

}; // end MultipleChoiceController


// main control flow

var area = JSON.parse(sessionStorage.getItem('area'));
var levels = [];
if (area) {
  levels = JSON.parse(sessionStorage.getItem(area+'_levels'));
}

if (levels && area) {
  initiate(area, levels);
} else {
  var url = (typeof area == 'string') ? ROOT_DIR+area : ROOT_DIR+"home";
  alert(error_no_symbols);
  window.location.replace(url);
}


function initiate (area, levels) {
  var kanaHandler;
  switch (area) {
    case 'hiragana':
      kanaHandler = new HiraganaHandler();
      break;
    case 'katakana':
      kanaHandler = new KatakanaHandler();
      break;
    default:
      break;
  }

  _area = area;
  _kanaHandler = kanaHandler;

  _kanaTrainer = new KanaTrainer (levels, _kanaHandler);

  // test if enough symbols for multiple choice are present
  if (_kanaTrainer.getTotalQuestionAmount()<4 && sessionStorage.getItem('multipleChoice')) {
    sessionStorage.removeItem('multipleChoice');
    alert(error_mc_switch);
  }

  // add button event handlers
  $("#kana-switch-mode-button").click(switchMode);
  $("#kana-results-button").click(function(){
    _kanaTrainer.save();
    window.location.replace(ROOT_DIR+"kanaresults");
  });
  $("#kana-reset-button").click(function(){
    sessionStorage.removeItem(_area+"_levels");
    sessionStorage.removeItem(_area+"_results");
    window.location.replace(ROOT_DIR+_area);
  });

  // display first question
  displayNewQuestion();

  // check if start with multipleChoice
  if (sessionStorage.getItem('multipleChoice')) {
    _playMultipleChoice = true;
    _controller = new MultipleChoiceController();
    sessionStorage.removeItem('multipleChoice');
  } else {
    _playMultipleChoice = false;
    _controller = new TextInputController();
  }

}

function displayNewQuestion () {
  var question = _kanaTrainer.nextQuestion();
  $("#kanaQuestionText").text(question);
  updateTryNumber();
  updateTotalCorrectNumber();
  if (_kanaTrainer.getTotalAmountPrompted()>=1 && _kanaTrainer.previousQuestion()) {
    displayLastQuestion();
  }
  if (_playMultipleChoice) {
    _controller.update();
  }
  _kanaTrainer.save();
}

function displayLastQuestion () {
  var prevQuestion = _kanaTrainer.previousQuestion();
  $(".kana-feedback-box .kana-feedback-symbol.lead").text(prevQuestion);
  $(".kana-feedback-box .kana-feedback-symbol").show();
}

function hideLastQuestion () {
  $(".kana-feedback-box .kana-feedback-symbol").hide();
}

function displayLastUserInput () {
  $(".kana-feedback-box .kana-feedback-user-input.lead").text(_userInput);
  $(".kana-feedback-box .kana-feedback-user-input").show();
}

function hideLastUserInput () {
  $(".kana-feedback-box .kana-feedback-user-input").hide();
}

function displayLastAnswer () {
  var prevAnswer = _kanaTrainer.previousAnswer();
  $(".kana-feedback-box .kana-feedback-correct-input.lead").text(prevAnswer);
  $(".kana-feedback-box .kana-feedback-correct-input").show();
}

function hideLastAnswer () {
  $(".kana-feedback-box .kana-feedback-correct-input").hide();
}

// AJAX call
function displayHintImage () {
  var question = _kanaTrainer.currentQuestion();

  $.ajax ({
    method: "POST",
    url: ROOT_DIR+"api/kanatrainer.hint.php",
    data: {
      area: _area,
      name: _kanaHandler.getText(question),
      type: "image"
    }
  })
  .done(function(data) {
    if(data !== '404') {
      $(".kana-hint-image").html(data);
      $(".kana-hint-box").show();
      //$("div.kana-hint-image").get(0).scrollIntoView();
      window.scrollTo(0,75);
    }
  });
}

function hideHint () {
  hideHintText();
  $(".kana-hint-box").hide();
}

// AJAX call
function displayHintText() {
  var question = _kanaTrainer.currentQuestion();

  $.ajax ({
    method: "POST",
    url: ROOT_DIR+"api/kanatrainer.hint.php",
    data: {
      area: _area,
      name: _kanaHandler.getText(question),
      type: "text"
    }
  })
  .done(function(data) {
    if(data !== '404') {
      $(".kana-hint-text").html('<strong>Remember:</strong> '+data);
      $(".kana-hint-text").show();
    }
  });
}

function hideHintText() {
  $('.kana-hint-text').hide();
}

function updateTryNumber () {
  var tryNr = _kanaTrainer.getCurrentTryNumber();
  $("#kanaStatisticsTryNr").text(tryNr+" / 2");
}

function updateTotalCorrectNumber () {
  var correctNr = _kanaTrainer.getTotalAmountCorrect();
  var totalNr = _kanaTrainer.getTotalAmountPrompted();
  $("#kanaStatisticsCorrectNr").text(correctNr+" / "+totalNr);
}

function handleNegativeFeedback () {
  updateTryNumber();
  displayLastUserInput();

  $("#kana-feedback-title").removeClass("alert-success");
  $("#kana-feedback-title").addClass("alert-danger");
  $("#kana-feedback-title").text(text_wrong);
  $("#kana-feedback-title").show();

  // user entered two times wrong value
  if (_kanaTrainer.getCurrentTryNumber() > 2) {
    displayHintText();
    displayNewQuestion();
    displayLastAnswer();
  } else { // second chance
    hideLastAnswer();
    hideLastQuestion();
    hideHintText();
    displayHintImage();
  }
}

function handlePositiveFeedback () {
  displayNewQuestion();
  displayLastUserInput();
  hideLastAnswer();
  hideHint();

  $("#kana-feedback-title").removeClass("alert-danger");
  $("#kana-feedback-title").addClass("alert-success");
  $("#kana-feedback-title").text(text_correct);
  $("#kana-feedback-title").show();
}

function switchMode () {
  if (!_kanaTrainer.multipleChoiceIsPossible()) {
    alert(error_mc_switch);
    return;
  }

  _playMultipleChoice = !_playMultipleChoice;

  if (_playMultipleChoice) {
    _controller = new MultipleChoiceController();
  } else {
    _controller = new TextInputController();
  }
}
