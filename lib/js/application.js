$(document).ready(function(){
  var mainSection = getMainSection();
  activateMenuItem(mainSection);
});


function activateMenuItem (section) {
  var menuItem = $( "#"+section );
  menuItem.addClass("active");
}

function getMainSection () {
  var loc = window.location.href;
  var locParts = loc.split("/");
  var pos = locParts.length;

  // get first real string-fragment from URL's end
  while ( locParts[--pos].length<1 );
  var section = locParts[pos];

  // go to previous fragments of URL until domain (".ch") is found
  while ( !( section.length > 3 && section.substring(section.length-3, section.length)==".ch" ) ) {
    section = locParts[--pos];
  }

  // main section is the part directly after domain
  var mainSection = locParts[++pos];

  // set mainSection to home if no subdir is present in URL
  if (mainSection.length<1) {
    mainSection = 'home';
  }

  return mainSection;
}
