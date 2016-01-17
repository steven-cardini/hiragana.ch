$(function(){

  $('.js-language li a').on('click', function (event) {
    event.preventDefault();
    var lang = $(this).data('lang');

    document.cookie = "lang=" + lang;
    location.reload();
  });

  if (CURRENT_PAGE === 'home') {
    maximizeLoginForm();
  } else if (CURRENT_PAGE === 'login') {
    hideLoginForm();
  } else {
    minimizeLoginForm();
  }
});

var CURRENT_PAGE =  getCurrentPage();

// var ROOT_DIR is defined in index.php
function getCurrentPage () {
  var pattern = (ROOT_DIR.length>1) ? ROOT_DIR : '.ch';
  var url = window.location.href;
  var n = url.search(pattern); // .ch/
  if (url.length <= n+pattern.length) {
    return 'home';
  }
  var subUrl = url.substring(n+pattern.length);
  var urlParts = subUrl.match(/[A-Za-z-]+/g);
  return urlParts.join('/');
}

function maximizeLoginForm () {
  $("#switch-signin").hide();
  $(".remove-signin").show();
  $(".remove-signin").click(minimizeLoginForm);
  $(".form-signin").show();
  $("aside.wrapper-signin").show();
  $("#inputEmail").focus();
}

function minimizeLoginForm () {
  $(".remove-signin").hide();
  $("#switch-signin").show();
  $("#switch-signin").click(maximizeLoginForm);
  $(".form-signin").hide();
  $("aside.wrapper-signin").show();
}

function hideLoginForm () {
  $("aside.wrapper-signin").hide();
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
