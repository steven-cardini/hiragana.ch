var area = getArea();
var kanaHandler = getKanaHandler();

// if a training session was already started, redirect to kana trainer directly
if (sessionStorage.getItem(area+"-levels")) {
    window.location.replace(ROOT_DIR+"kana/"+area+"/trainer");
} else { // no previous training session was started
  addSelectionRows();
  $("#kana-select-form").attr("action", ROOT_DIR+"kana/"+area+"/trainer");
  $("#kana-select-form-select-all").click(selectAll);
  $("#kana-select-form-deselect-all").click(deselectAll);
  $("#kana-select-form").submit(validateSelection);
}


// _KANA_HANDLER is defined by katakana.def.js or hiragana.def.js, based on page location
function addSelectionRows () {
  var kanaLevelSymbols = [];
  for (var i=0; i<kanaHandler.getNumberOfLevels(); i++) {
    kanaLevelSymbols.push(kanaHandler.getSymbolsFromLevel(i));
  }

  // iterate over levels and add a new line for each
  for (i=0; i<kanaLevelSymbols.length; i++) {

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
    $("#kana-select-levels").append('<label class="kana-selector-label"><input type="checkbox" class="kana-selector-checkbox" value="'+i+'">'+symbols+'</label>');
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
    alert(error_no_symbols);
    return false;
  }
  // user has checked multiple choice checkbox
  if ($("#kana-multiple-choice-checkbox").prop('checked')) {
    sessionStorage.setItem("multipleChoice", "true");
  }
  // store levels to session, so that it can be retrieved from kanatrainer (new page)
  sessionStorage.setItem(area+"-levels", JSON.stringify(levels));  // hiragana_levels or katakana_levels stores selected levels
  // validation was successful
  return true;
}
