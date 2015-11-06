$(function(){

  $('.js-language li a').on('click', function (event) {
    event.preventDefault();
    var lang = $(this).data('lang');

    document.cookie = "lang=" + lang;
    location.reload();
  });

  if (CURRENT_PAGE == 'home') {
    showLoginForm();
  } else {
    hideLoginForm();
  }
});

var ROOT_DIR = "/hiragana.ch/"; // DEV
// var ROOT_DIR = "/";          // PROD

var CURRENT_PAGE =  getCurrentPage();

function getCurrentPage () {
  var url = window.location.href;
  var urlParts = url.split("/");
  var location = urlParts[urlParts.length-1];
  location = (location.length>0) ? location : 'home';
  return location;
}

function showLoginForm () {
  $("#switch-signin").hide();
  $(".remove-signin").show();
  $(".remove-signin").click(hideLoginForm);
  $(".form-signin").show();
}

function hideLoginForm () {
  $(".remove-signin").hide();
  $("#switch-signin").show();
  $("#switch-signin").click(showLoginForm);
  $(".form-signin").hide();
}

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
