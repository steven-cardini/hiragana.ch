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
    //ele += '<input type="submit" id="kanaAnswerSubmitButton" class="btn btn-primary btn-lg btn-block" value="Check">';
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

};


var MultipleChoiceController = function () {

  // constructor
  // remove text input field and large button, add multiple choice
  $("#kanaAnswerForm").remove();
  initializeMultipleChoice();

  function initializeMultipleChoice () {
    var ele = '<div id="kanaMultipleChoiceArea">';
    ele += '<div class="row">';
    ele += '<div class="col-sm-6"><button type="button" class="btn btn-default btn-lg btn-block">0</button></div>';
    ele += '<div class="col-sm-6"><button type="button" class="btn btn-default btn-lg btn-block">1</button></div>';
    ele += '</div>';
    ele += '<div class="row">';
    ele += '<div class="col-sm-6"><button type="button" class="btn btn-default btn-lg btn-block">2</button></div>';
    ele += '<div class="col-sm-6"><button type="button" class="btn btn-default btn-lg btn-block">3</button></div>';
    ele += '</div>';
    ele += '</div>';

    $("#kana-prompt-box").append(ele);
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
    updateMultipleChoice();
    if (_kanaTrainer.validate(_userInput)) {  //answer is correct
      handlePositiveFeedback();
    } else {  // answer was false
      handleNegativeFeedback();
    }
  });

};

var area = JSON.parse(sessionStorage.getItem('area'));
var levels = [];
if (area) {
  levels = JSON.parse(sessionStorage.getItem(area+'_levels'));
}


if (levels && area) {
  initiate(area, levels);
} else {
  alert('Please first choose your symbols!');
  window.location.replace(ROOT_DIR+"home");
}



function initiate (area, levels) {
  // add button event handlers
  $("#kanaSwitchModeButton").click(switchMode);

  var kanaHandler;
  switch (area) {
    case 'hiragana':
    kanaHandler = new HiraganaHandler();
    break;
    case 'katakana':
    kanaHandler = new KatakanaHandler();
    default:
    break;

  }

  _kanaTrainer = new KanaTrainer (levels, kanaHandler);

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
  if (_kanaTrainer.getCurrentQuestionNumber()>1) {
    displayLastQuestion();
  }
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

function updateTryNumber () {
  var tryNr = _kanaTrainer.getCurrentTryNumber();
  $("#kanaStatisticsTryNr").text(tryNr+" / 2");
}

function updateTotalCorrectNumber () {
  var correctNr = _kanaTrainer.getTotalAmountCorrect();
  var totalNr = _kanaTrainer.getCurrentQuestionNumber()-1;
  $("#kanaStatisticsCorrectNr").text(correctNr+" / "+totalNr);
}

function handleNegativeFeedback () {
  updateTryNumber();
  displayLastUserInput();

  $("#kana-feedback-title").removeClass("alert-success");
  $("#kana-feedback-title").addClass("alert-danger");
  $("#kana-feedback-title").text("WRONG");
  $("#kana-feedback-title").show();

  // user entered two times wrong value
  if (_kanaTrainer.getCurrentTryNumber() > 2) {
    displayNewQuestion();
    displayLastAnswer();
  } else { // second chance
    hideLastAnswer();
    hideLastQuestion();
  }

}

function handlePositiveFeedback () {
  displayNewQuestion();
  displayLastUserInput();
  hideLastAnswer();

  $("#kana-feedback-title").removeClass("alert-danger");
  $("#kana-feedback-title").addClass("alert-success");
  $("#kana-feedback-title").text("CORRECT");
  $("#kana-feedback-title").show();
}

function switchMode () {
  if (!_kanaTrainer.multipleChoiceIsPossible()) {
    alert("Not enough symbols to display multiple choice!");
    return;
  }

  _playMultipleChoice = !_playMultipleChoice;

  if (_playMultipleChoice) {
    _controller = new MultipleChoiceController();
  } else {
    _controller = new TextInputController();
  }
}
