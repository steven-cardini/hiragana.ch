var handler = new HiraganaHandler();
var symbols = handler.getSymbolsFromLevel(selectedLevel);
var keys = Object.keys(symbols);

var details = '';

for (var i=0; i<keys.length; i++) {
  details += getDetails(symbols, keys, i);
}

addSelectionRows();
$("#kana-learn-wrapper").append(details);


function addSelectionRows () {
  var kanaLevelSymbols = [];
  for (var i=0; i<handler.getNumberOfLevels(); i++) {
    kanaLevelSymbols.push(handler.getSymbolsFromLevel(i));
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
    if (i===selectedLevel) {
      $("#kana-select-levels").append('<label class="kana-selector-label" style="background-color: #ccc; cursor: default;">'+symbols+'</label>');

    } else {
      $("#kana-select-levels").append('<a href="'+ROOT_DIR+'learn-hiragana/'+i+'"><label class="kana-selector-label">'+symbols+'</label></a>');
    }
  }
}

function getDetails(symbols, keys, i) {
  var table = '<table class="kana-learn-table"><tr>';
  table += '<td>';
  table += '<span class="visible-xs kana-learn-text">'+symbols[keys[i]]+'</span>';
  table += '<span class="hidden-xs kana-learn-text">'+symbols[keys[i]]+'</span>';
  table += '</td>';
  table += '<td>';
  table += '<img class="visible-xs kana-learn-image" src="'+ROOT_DIR+'img/japanese/hiragana/'+keys[i]+'.jpg" />';
  table += '<img class="hidden-xs kana-learn-image" src="'+ROOT_DIR+'img/japanese/hiragana/'+keys[i]+'.jpg" />';
  table += '</td>';
  table += '</tr></table>';

  var description = '<p>jsdfhjkahfuish<jknsdjkafjk</p>';
  return table+description;
}
