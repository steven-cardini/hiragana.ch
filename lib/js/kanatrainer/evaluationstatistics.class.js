var EvaluationStatistics = function (questions) {

  // constructor
  var symbolsTotalAsked = [];
  var symbolsTotalCorrect = [];
  for (i=0; i<questions.length; i++) {
    symbolsTotalAsked[questions[i]] = 0;
    symbolsTotalCorrect[questions[i]] = 0;
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

}
