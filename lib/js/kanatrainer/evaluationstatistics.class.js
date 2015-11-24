var EvaluationStatistics = function (questions) {

  // constructor
  var symbolsTotalAsked = [];
  var symbolsTotalCorrect = [];
  for (i=0; i<questions.length; i++) {
    symbolsTotalAsked[questions[i]] = 0;
    symbolsTotalCorrect[questions[i]] = 0;
  }

  this.load = function (sta, stc) {
    for (var symbol in sta) {
      symbolsTotalAsked[symbol] = sta[symbol];
    }
    for (var symbol in stc) {
      symbolsTotalCorrect[symbol] = stc[symbol];
    }
  }

  this.newQuestion = function (question) {
    symbolsTotalAsked[question]++;
  };

  this.correctQuestion = function (question) {
    symbolsTotalCorrect[question]++;
  };

  this.getAmountPrompted = function (question) {
    return symbolsTotalAsked[question];
  }

  this.getAmountCorrect = function (question) {
    return symbolsTotalCorrect[question];
  }

  this.getTotalAmountPrompted = function () {
    var count = 0;
    for (var symbol in symbolsTotalAsked) {
      count += symbolsTotalAsked[symbol];
    }
    return count;
  }

  this.getTotalAmountCorrect = function () {
    var count = 0;
    for (var symbol in symbolsTotalCorrect) {
      count += symbolsTotalCorrect[symbol];
    }
    return count;
  }

}
