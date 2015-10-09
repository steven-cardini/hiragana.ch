var _kanaTrainer;
var _controller;
var _playMultipleChoice;

$(document).ready(function() {

  var levels = JSON.parse(sessionStorage.getItem('levels'));
  sessionStorage.removeItem('levels');

  if (levels) {
    initiate(levels);
  } else {
    alert('Please first choose your symbols!');
    window.location.replace(ROOT_DIR+"hiragana");
  }

});


function initiate (levels) {
  // add button event handlers
  $("#kanaSwitchModeButton").click(switchMode);

  var kanaHandler;
  switch (sessionStorage.getItem('area')) {
    case 'hiragana':
    kanaHandler = new HiraganaHandler();
      break;
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
  console.log('display new question');
  var question = _kanaTrainer.nextQuestion();
  $("#kanaQuestionText").text(question);
}


function handleNegativeFeedback () {
  $("#kanaFeedbackText").addClass("alert-danger");
  $("#kanaFeedbackText").removeClass("alert-success");
  $("#kanaFeedbackText").text("FALSE");

  $("#kanaFeedbackLastAnswer").text('');
  $("#kanaFeedbackLastQuestion").text('');
}

function handlePositiveFeedback () {
  displayNewQuestion();

  $("#kanaFeedbackText").removeClass("alert-danger");
  $("#kanaFeedbackText").addClass("alert-success");
  $("#kanaFeedbackText").text("CORRECT");

  $("#kanaFeedbackLastAnswer").text(_kanaTrainer.previousAnswer());
  $("#kanaFeedbackLastQuestion").text(_kanaTrainer.previousQuestion());
}

function switchMode () {
  _playMultipleChoice = !_playMultipleChoice;

  if (_playMultipleChoice) {
    _controller = new MultipleChoiceController();
  } else {
    _controller = new TextInputController();
  }
}


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
  }

  // user clicked submit button below input field
  $("#kanaAnswerSubmitButton").click(function () {
    var answer = $("#kanaAnswerTextfield").val();
    $("#kanaAnswerTextfield").val('');
    answer = answer.toLowerCase();

    if (_kanaTrainer.validate(answer)) {  //answer is correct
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
    var answer = $(this).attr('value');
    if (_kanaTrainer.validate(answer)) {  //answer is correct
      handlePositiveFeedback();
      updateMultipleChoice();
    } else {  // answer was false
      handleNegativeFeedback();
    }
  });


};
