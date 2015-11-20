var EvaluationStatistics = function (questions) {

  // constructor
  var symbolsTotalAsked = [];
  var symbolsTotalCorrect = [];
  for (i=0; i<questions.length; i++) {
    console.log("Adding symbol "+questions[i]);
    symbolsTotalAsked[questions[i]] = 0;
    symbolsTotalCorrect[questions[i]] = 0;
  }

  this.newQuestion = function (question) {
    symbolsTotalAsked[question]++;
    console.log("question: "+question);
    console.log("amount: "+symbolsTotalAsked[question]);
  };

  this.correctQuestion = function (question) {
    symbolsTotalCorrect[question]++;
  };

}
