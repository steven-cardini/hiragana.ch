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
    ele += '<input type="submit" id="kanaAnswerSubmitButton" class="btn btn-primary btn-lg btn-block" value="Check">';
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
  $("#kanaAnswerSubmitButton").click(function () {
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
    if (_kanaTrainer.validate(_userInput)) {  //answer is correct
      handlePositiveFeedback();
      updateMultipleChoice();
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
  updateTotalNumber();
}


function displayLastAnswer () {
  var prevQuestion = _kanaTrainer.previousQuestion();
  var prevAnswer = _kanaTrainer.previousAnswer();
  $("#kana-feedback-last-answer-title").text("Correct answer:");
  $("#kana-feedback-last-answer-value").text(prevQuestion+" = "+prevAnswer);
}

function clearLastAnswer () {
  $("#kana-feedback-last-answer-title").text("");
  $("#kana-feedback-last-answer-value").text("");
}

function updateTryNumber () {
  var tryNr = _kanaTrainer.getCurrentQuestionTryNumber();
  $("#kanaStatisticsTryNr").text("Try "+tryNr+" / 2");
}

function updateTotalNumber () {
  var totalNr = _kanaTrainer.getCurrentQuestionTotalNumber();
  $("#kanaStatisticsTotalNr").text("Prompt "+totalNr);
}


function handleNegativeFeedback () {
  updateTryNumber();
  $(".kana-feedback-box").css('background-color', 'red');
  $("#kana-feedback-title").text("WRONG");
  $("#kana-feedback-your-input-title").text("Your answer: ");
  $("#kana-feedback-your-input-value").text(''+_userInput);

  // user entered two times wrong value
  if (_kanaTrainer.getCurrentQuestionTryNumber() > 2) {
    displayNewQuestion();
    displayLastAnswer();
  } else { // second chance
    clearLastAnswer();
  }

}

function handlePositiveFeedback () {
  displayNewQuestion();
  displayLastAnswer();

  $(".kana-feedback-box").css('background-color', '#00FF00');
  $("#kana-feedback-title").text("CORRECT");
  $("#kana-feedback-your-input-title").text('');
  $("#kana-feedback-your-input-value").text('');
}

function switchMode () {
  _playMultipleChoice = !_playMultipleChoice;

  if (_playMultipleChoice) {
    _controller = new MultipleChoiceController();
  } else {
    _controller = new TextInputController();
  }
}
