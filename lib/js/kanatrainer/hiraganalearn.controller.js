var handler = new HiraganaHandler();
var symbols = handler.getSymbolsFromLevel(0);
var keys = Object.keys(symbols);

var overview = getOverview(symbols, keys);
var details = '';

for (var i=0; i<keys.length; i++) {
  details += getDetails(symbols, keys, i);
}

$("#kana-learn-wrapper").append(overview);
$("#kana-learn-wrapper").append(details);

function getOverview(symbols, keys) {
  var table = '<table class="kana-learn-overview"><tr>';
  for (var i=0; i<keys.length; i++) {
    table += '<td>';
    table += '<span class="visible-xs kana-learn-text">'+symbols[keys[i]]+'</span>';
    table += '<span class="hidden-xs kana-learn-text">'+symbols[keys[i]]+'</span>';
    table += '</td>';
  }
  table += '</tr></table>';
  return table;
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
