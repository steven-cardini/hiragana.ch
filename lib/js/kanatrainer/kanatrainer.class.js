// input: array of levels that the user selected to practice
var KanaTrainer = function (levels, kanaHandler) {

  // private instance variables
  var _questions = []; // object containing  the question answer pairs (e.g. "ka": "か")
  var _questionAmount = 0;
  var _evaluationStatistics; // separate js "class" evaluationstatistics.class.ja
  var _previousQuestion = "";
  var _currentQuestion = "";  // symbol
  var _currentTryNumber = 0;
  var _firstQuestion = true;
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

  var loadResults = function () {
    var area = JSON.parse(sessionStorage.getItem('area'));
    if (!sessionStorage.getItem(area+"_results")) {
      return; // no persisted data present
    }

    var persistedData = JSON.parse(sessionStorage.getItem(area+'_results'));
    var symbolsTotalAsked = [];
    var symbolsTotalCorrect = [];

    for (var i=0; i<persistedData.length; i++) {
      symbolsTotalAsked[persistedData[i].question] = persistedData[i].prompted;
      symbolsTotalCorrect[persistedData[i].question] = persistedData[i].correct;
    }

    _evaluationStatistics.load(symbolsTotalAsked, symbolsTotalCorrect);
  };

  // "constructor"
  _kanaHandler = kanaHandler;

  // aliment _questions
  for (i=0; i<levels.length; i++) {
    _questions = collect (_questions, _kanaHandler.getSymbolsFromLevel(levels[i]));
  }

  // define total number of different questions
  var key;
  var q = [];
  for (key in _questions) {
    if (_questions.hasOwnProperty(key)) {
      _questionAmount++;
      q.push(_questions[key]);
    }
  }

  _evaluationStatistics = new EvaluationStatistics (q);
  loadResults();  // check if a training session has already been started and if yes load data

  _currentQuestion = getRandomSymbol();


  this.nextQuestion = function () {  //public
    if (!_firstQuestion) {
      _evaluationStatistics.newQuestion(_currentQuestion);
      _previousQuestion = _currentQuestion;
    }
    _currentTryNumber = 1;

    while (_currentQuestion === _previousQuestion) {
      _currentQuestion = getRandomSymbol();
    }

    _firstQuestion = false;
    return _currentQuestion;
  };

  this.currentQuestion = function () {
    return _currentQuestion;
  }

  this.previousQuestion = function () {
    return _previousQuestion;
  };

  this.previousAnswer = function () {
    return _kanaHandler.getText(_previousQuestion);
  };

  this.getTotalAmountPrompted = function () {
    return _evaluationStatistics.getTotalAmountPrompted();
  }

  this.getTotalAmountCorrect = function () {
    return _evaluationStatistics.getTotalAmountCorrect();
  }

  this.getCurrentTryNumber = function () {
    return _currentTryNumber;
  }

  this.multipleChoiceIsPossible = function () {
    return _questionAmount >= 4;
  }

  this.getMultipleChoiceOptions = function () {
    var num =0;
    var amount = 4;
    var multipleChoice = [];
    var mc = _kanaHandler.getText(_currentQuestion);
    multipleChoice.push(mc);

    for (i=0; i<amount-1; i++) {
      while (multipleChoice.indexOf(mc) > -1) {
        mc = _kanaHandler.getText(getRandomSymbol ());
      }
      multipleChoice.push(mc);
    }

    multipleChoice = shuffleArray(multipleChoice);
    return multipleChoice;
  };

  this.validate = function (answer) {
    var isCorrect = (answer === _kanaHandler.getText(_currentQuestion));
    if (!isCorrect) {
      _currentTryNumber++;
    } else {
      _evaluationStatistics.correctQuestion(_currentQuestion);
    }
    return isCorrect;
  };

  this.save = function () {
    var area = JSON.parse(sessionStorage.getItem('area'));
    var persistedData = [];
    for (key in _questions) {
      var question = _questions[key];
      var prompted = _evaluationStatistics.getAmountPrompted(question);
      var correct = _evaluationStatistics.getAmountCorrect(question);
      if (prompted<=0)
        continue;
      persistedData.push({ 'question': question, 'prompted': prompted, 'correct': correct });
    }
    sessionStorage.setItem(area+"_results", JSON.stringify(persistedData));
  };



};
