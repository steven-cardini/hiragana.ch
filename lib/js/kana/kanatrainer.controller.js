var area = getArea();
var kanaHandler = getKanaHandler();
var kanaTrainer;
var controller;
var playMultipleChoice;
var userInput;

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

    userInput = $("#kanaAnswerTextfield").val();

    if (typeof userInput === undefined || userInput === "") { // user did not enter anything
      return;
    }

    $("#kanaAnswerTextfield").val('');
    userInput = userInput.toLowerCase();

    if (kanaTrainer.validate(userInput)) {  //answer is correct
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
    var multipleChoice = kanaTrainer.getMultipleChoiceOptions();
    var buttons = $("button.btn-block");
    var i = 0;
    $.each(buttons, function() {
      $(this).attr('value', multipleChoice[i]);
      $(this).html(multipleChoice[i++]);
    });
  }


  // user clicked a multiple choice button
  $('button.btn-block').click(function(){
    userInput = $(this).attr('value');
    if (kanaTrainer.validate(userInput)) {  //answer is correct
      handlePositiveFeedback();
    } else {  // answer was false
      handleNegativeFeedback();
    }
  });

}; // end MultipleChoiceController


// MAIN CONTROL FLOW

var levels = [];
if (area) {
  levels = JSON.parse(sessionStorage.getItem(area+'-levels'));
}

if (levels && area) {
  initiate(area, levels);
} else { // not all necessary information was selected, redirect to selection page
  if (area==="hiragana") {
    url = ROOT_DIR+"kana/hiragana/select";
  } else if (area==="katakana") {
    url = ROOT_DIR+"kana/katakana/select";
  } else {
    url = ROOT_DIR+"home";
  }
  alert(error_no_symbols);
  window.location.replace(url);
}


function initiate (area, levels) {
  kanaTrainer = new KanaTrainer (levels, kanaHandler);

  // test if enough symbols for multiple choice are present
  if (kanaTrainer.getTotalQuestionAmount()<4 && sessionStorage.getItem('multipleChoice')) {
    sessionStorage.removeItem('multipleChoice');
    alert(error_mc_switch);
  }

  // add button event handlers
  $("#kana-switch-mode-button").click(switchMode);
  $("#kana-results-button").click(function(){
    kanaTrainer.save();
    window.location.replace(ROOT_DIR+"kana/"+area+"/results");
  });
  $("#kana-reset-button").click(function(){
    sessionStorage.removeItem(area+"-levels");
    sessionStorage.removeItem(area+"-results");
    window.location.replace(ROOT_DIR+"kana/"+area+"/select");
  });

  // display first question
  displayNewQuestion();

  // check if start with multipleChoice
  if (sessionStorage.getItem('multipleChoice')) {
    playMultipleChoice = true;
    controller = new MultipleChoiceController();
    sessionStorage.removeItem('multipleChoice');
  } else {
    playMultipleChoice = false;
    controller = new TextInputController();
  }

}

function displayNewQuestion () {
  var question = kanaTrainer.nextQuestion();
  $("#kanaQuestionText").text(question);
  updateTryNumber();
  updateTotalCorrectNumber();
  if (kanaTrainer.getTotalAmountPrompted()>=1 && kanaTrainer.previousQuestion()) {
    displayLastQuestion();
  }
  if (playMultipleChoice) {
    controller.update();
  }
  kanaTrainer.save();
}

function displayLastQuestion () {
  var prevQuestion = kanaTrainer.previousQuestion();
  $(".kana-feedback-box .kana-feedback-symbol.lead").text(prevQuestion);
  $(".kana-feedback-box .kana-feedback-symbol").show();
}

function hideLastQuestion () {
  $(".kana-feedback-box .kana-feedback-symbol").hide();
}

function displayLastUserInput () {
  $(".kana-feedback-box .kana-feedback-user-input.lead").text(userInput);
  $(".kana-feedback-box .kana-feedback-user-input").show();
}

function hideLastUserInput () {
  $(".kana-feedback-box .kana-feedback-user-input").hide();
}

function displayLastAnswer () {
  var prevAnswer = kanaTrainer.previousAnswer();
  $(".kana-feedback-box .kana-feedback-correct-input.lead").text(prevAnswer);
  $(".kana-feedback-box .kana-feedback-correct-input").show();
}

function hideLastAnswer () {
  $(".kana-feedback-box .kana-feedback-correct-input").hide();
}

// AJAX call
function displayHintImage () {
  var question = kanaTrainer.currentQuestion();

  $.ajax ({
    method: "POST",
    url: ROOT_DIR+"api/kanatrainer.hint.php",
    data: {
      area: area,
      name: kanaHandler.getText(question),
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
  var question = kanaTrainer.currentQuestion();

  $.ajax ({
    method: "POST",
    url: ROOT_DIR+"api/kanatrainer.hint.php",
    data: {
      area: area,
      name: kanaHandler.getText(question),
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
  var tryNr = kanaTrainer.getCurrentTryNumber();
  $("#kanaStatisticsTryNr").text(tryNr+" / 2");
}

function updateTotalCorrectNumber () {
  var correctNr = kanaTrainer.getTotalAmountCorrect();
  var totalNr = kanaTrainer.getTotalAmountPrompted();
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
  if (kanaTrainer.getCurrentTryNumber() > 2) {
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
  if (!kanaTrainer.multipleChoiceIsPossible()) {
    alert(error_mc_switch);
    return;
  }

  playMultipleChoice = !playMultipleChoice;

  if (playMultipleChoice) {
    controller = new MultipleChoiceController();
  } else {
    controller = new TextInputController();
  }
}
