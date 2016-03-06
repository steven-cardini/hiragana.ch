// used to define area (hiragana or katakana) for the other kana js files
var area = "undefined";
var path = window.location.pathname;
if (/kana\/hiragana/.test(path)) {
  area = "hiragana";
} else if (/kana\/katakana/.test(path)) {
  area = "katakana";
}

function getArea() {
  return area;
}

function getKanaHandler() {
  if (area === "hiragana") {
    return new HiraganaHandler();
  } else if (area === "katakana") {
    return new KatakanaHandler();
  } else {
    return null;
  }
}
