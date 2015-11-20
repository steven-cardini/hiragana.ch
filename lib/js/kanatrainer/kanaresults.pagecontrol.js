var area = JSON.parse(sessionStorage.getItem('area'));
var results = JSON.parse(sessionStorage.getItem(area+"_results"));

for (i=0; i<results.length; i++) {
  console.log("Symbol: "+results[i].question+"; Prompted: "+results[i].prompted+"; Correct: "+results[i].correct);
}
