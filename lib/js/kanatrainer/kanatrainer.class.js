// input: array of levels that the user selected to practice
var KanaTrainer = function (levels, kanaHandler) {

  // private instance variables
  var _questions = []; // object containing  the question answer pairs (e.g. "ka": "か")
  var _questionAmount = 0;
  var _evaluationStatistics; //TODO: create class for evaluation
  var _previousQuestion = "";
  var _currentQuestion = "";  // symbol
  var _currentQuestionTryNumber = 1;
  var _kanaHandler;

  // private functions
  var getRandomSymbol = function () {
    var result;
    var count = 0;
    for (var prop in _questions) {
      if (Math.random() < 1/++count) {
        result = _questions[prop];
      }
    }
    return result;
  };

  var collect = function () {
    var ret = {};
    var len = arguments.length;
    for (var i=0; i<len; i++) {
      for (p in arguments[i]) {
        if (arguments[i].hasOwnProperty(p)) {
          ret[p] = arguments[i][p];
        }
      }
    }
    return ret;
  };

  // "constructor"
  _kanaHandler = kanaHandler;
  for (i=0; i<levels.length; i++) {
    _questions = collect (_questions, _kanaHandler.getSymbolsFromLevel(levels[i]));
  }
  _questionAmount = _questions.length;

  _currentQuestion = getRandomSymbol();


  this.nextQuestion = function () {  //public
    _previousQuestion = _currentQuestion;
    _currentQuestionTryNumber = 1;

    while (_currentQuestion == _previousQuestion) {
      _currentQuestion = getRandomSymbol();
    }

    return _currentQuestion;
  };

  this.previousQuestion = function () {
    return _previousQuestion;
  };

  this.previousAnswer = function () {
    return _kanaHandler.getText(_previousQuestion);
  };

  this.getCurrentQuestionTryNumber = function () {
    return _currentQuestionTryNumber;
  }

  this.getMultipleChoiceOptions = function () {
    var multipleChoice = [];
    var mc = _kanaHandler.getText(_currentQuestion);
    multipleChoice.push(mc);

    for (i=0; i<3; i++) {
      while (multipleChoice.indexOf(mc) > -1) {
        mc = _kanaHandler.getText(getRandomSymbol ());
      }
      multipleChoice.push(mc);
    }

    multipleChoice = shuffleArray(multipleChoice);
    return multipleChoice;
  };

  this.validate = function (answer) {
    var isCorrect = (answer == _kanaHandler.getText(_currentQuestion));
    if (!isCorrect) {
      _currentQuestionTryNumber++;
    }
    return isCorrect;
  };

};
