$(document).ready(function(){

  $('.js-language li a').on('click', function (event) {
    event.preventDefault();
    var lang = $(this).data('lang');

    $.post(ROOT_DIR + 'api/set_lang.php', {lang: lang}, function (){
      location.reload();
    });
  });
});

var ROOT_DIR = "/hiragana.ch/"; // DEV
// var ROOT_DIR = "/";          // PROD

function shuffleArray (array) {
  var currentIndex = array.length, temporaryValue, randomIndex ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}
