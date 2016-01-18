$("#kana-back-button").click(function(){
  window.location.replace(ROOT_DIR+"kanatrainer");
});

var area = JSON.parse(sessionStorage.getItem('area'));
var results = JSON.parse(sessionStorage.getItem(area+"_results"));

// sort results array by percentage correct ASC
results.sort(function(a,b){
  return a.correct/a.prompted - b.correct/b.prompted;
});

for (i=0; i<results.length; i++) {
  var percentage = Math.round((results[i].correct / results[i].prompted)*100);

  var progressBarClass;
  if (percentage>=80) {
    progressBarClass = 'progress-bar-success';
  } else if (percentage>=50) {
    progressBarClass = 'progress-bar-warning';
  } else {
    progressBarClass = 'progress-bar-danger';
  }

  var width = (percentage>=20) ? percentage : 20;

  var colSymbol = '<td><span class="h3">'+results[i].question+'</td>';
  var colScore = '<td>'+results[i].correct+'/'+results[i].prompted+'</td>';
  var colPercentage = '<td><div class="progress-bar '+progressBarClass+'" role="progressbar" aria-valuenow="'+percentage+'" aria-valuemin="0" aria-valuemax="100" style="width: '+width+'%">'+percentage+' %</div></td>';

  var row = '<tr>'+colSymbol+colScore+colPercentage+'</tr>';
  $(row).appendTo($("#kanaResultsTable tbody"));
}
