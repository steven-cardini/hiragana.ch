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
  var n = url.search(".ch"); // .ch/
  if (url.length <= n+4) {
    return 'home';
  }
  var subUrl = url.substring(n+4);
  var urlParts = subUrl.match(/[A-Za-z-]+/g);
  return urlParts.join('/');
}

function showLoginForm () {
  $("#switch-signin").hide();
  $(".remove-signin").show();
  $(".remove-signin").click(hideLoginForm);
  $(".form-signin").show();
  $("aside.wrapper-signin").show();
  $("#inputEmail").focus();
}

function hideLoginForm () {
  $(".remove-signin").hide();
  $("#switch-signin").show();
  $("#switch-signin").click(showLoginForm);
  $(".form-signin").hide();
  $("aside.wrapper-signin").show();
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
