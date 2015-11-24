// area stores 'hiragana' or 'katakana' respectively in browser session
sessionStorage.setItem("area", JSON.stringify(_AREA));

// if a training session was already started, redirect to kana trainer directly
if (sessionStorage.getItem(_AREA+"_levels")) {
    window.location.replace(ROOT_DIR+"kanatrainer");
} else { // no previous training session was started
  addSelectionRows();
  $("#kanaSelectFormSelectAll").click(selectAll);
  $("#kanaSelectFormDeselectAll").click(deselectAll);
  $("#kanaSelectForm").submit(validateSelection);
}


// _KANA_HANDLER is defined by katakana.def.js or hiragana.def.js, based on page location
function addSelectionRows () {
  var kanaLevelSymbols = [];
  for (var i=0; i<_KANA_HANDLER.getNumberOfLevels(); i++) {
    kanaLevelSymbols.push(_KANA_HANDLER.getSymbolsFromLevel(i));
  }

  // iterate over levels and add a new line for each
  for (var i=0; i<kanaLevelSymbols.length; i++) {

    // iterate over symbols from a level and add them to the line
    var symbols = "";
    var keyIsSet = [];
    for (var key in kanaLevelSymbols[i]) {
      if (key=="ga") {
        symbols+="Dakuten";
        break;
      } else if (key=="kya") {
        symbols+="Digraphs";
        break;
      }
      if (!keyIsSet[i]) {
        symbols += key+":";
        keyIsSet[i]=true;
      }
      symbols += " "+kanaLevelSymbols[i][key];
    }
    $("#kanaSelectLevels").append('<label class="kana-selector-label"><input type="checkbox" class="kana-selector-checkbox" value="'+i+'">'+symbols+'</label>');
  }
}

function selectAll () {
  $(".kana-selector-checkbox").prop('checked', true);
}

function deselectAll () {
  $(".kana-selector-checkbox").prop('checked', false);
}

function validateSelection () {
  // retrieve selected levels
  var levels = [];

  $('input[type=checkbox]:checked.kana-selector-checkbox').each(function() {
    levels.push(this.value);
  });

  // verify that user selected at least one level
  if (levels.length<1) {
    alert('please select some symbols!');
    return false;
  }

  // user has checked multiple choice checkbox
  if ($("#kanaMultipleChoiceCheckbox").prop('checked')) {
    sessionStorage.setItem("multipleChoice", "true");
  }

  // store levels to session, so that it can be retrieved from kanatrainer (new page)
  sessionStorage.setItem(_AREA+"_levels", JSON.stringify(levels));  // hiragana_levels or katakana_levels stores selected levels

  // validation was successful
  return true;

}
