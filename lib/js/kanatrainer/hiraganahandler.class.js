var HiraganaHandler = function () {

  // private instance variables
  var _hiraganaCodes = [];
  var _hiraganaLevelCodes = [];
  var i = 0;

  // private functions
  var collect = function () {
    var ret = {};
    var len = arguments.length;
    for (var i=0; i<len; i++) {
      for (var p in arguments[i]) {
        if (arguments[i].hasOwnProperty(p)) {
          ret[p] = arguments[i][p];
        }
      }
    }
    return ret;
  };

  // constructor
  // Level 0
  _hiraganaLevelCodes.push ({
    "a" : "あ",
    "i" : "い",
    "u" : "う",
    "e" : "え",
    "o" : "お"
  });

  // Level 1
  _hiraganaLevelCodes.push ({
    "ka" : "か",
    "ki" : "き",
    "ku" : "く",
    "ke" : "け",
    "ko" : "こ"
  });

  // Level 2
  _hiraganaLevelCodes.push ({
    "sa" : "さ",
    "shi" : "し",
    "su" : "す",
    "se" : "せ",
    "so" : "そ"
  });

  // Level 3
  _hiraganaLevelCodes.push ({
    "ta" : "た",
    "chi" : "ち",
    "tsu" : "つ",
    "te" : "て",
    "to" : "と"
  });

  // Level 4
  _hiraganaLevelCodes.push ({
    "na" : "な",
    "ni" : "に",
    "nu" : "ぬ",
    "ne" : "ね",
    "no" : "の"
  });

  // Level 5
  _hiraganaLevelCodes.push ({
    "ha" : "は",
    "hi" : "ひ",
    "fu" : "ふ",
    "he" : "へ",
    "ho" : "ほ"
  });

  // Level 6
  _hiraganaLevelCodes.push ({
    "ma" : "ま",
    "mi" : "み",
    "mu" : "む",
    "me" : "め",
    "mo" : "も"
  });

  // Level 7
  _hiraganaLevelCodes.push ({
    "ya" : "や",
    "yu" : "ゆ",
    "yo" : "よ"
  });

  // Level 8
  _hiraganaLevelCodes.push ({
    "ra" : "ら",
    "ri" : "り",
    "ru" : "る",
    "re" : "れ",
    "ro" : "ろ"
  });

  // Level 9
  _hiraganaLevelCodes.push ({
    "wa" : "わ",
    "wo" : "を",
    "n" : "ん"
  });

  // Level 10 - dakuten
  _hiraganaLevelCodes.push ({
    "ga" : "が",
    "gi" : "ぎ",
    "gu" : "ぐ",
    "ge" : "げ",
    "go" : "ご",
    "za" : "ざ",
    "ji" : "じ",
    "zu" : "ず",
    "ze" : "ぜ",
    "zo" : "ぞ",
    "da" : "だ",
    "dzi" : "ぢ",
    "dzu" : "づ",
    "de" : "で",
    "do" : "ど",
    "ba" : "ば",
    "bi" : "び",
    "bu" : "ぶ",
    "be" : "べ",
    "bo" : "ぼ",
    "pa" : "ぱ",
    "pi" : "ぴ",
    "pu" : "ぷ",
    "pe" : "ぺ",
    "po" : "ぽ"
  });

  // Level 11 - digraphs
  _hiraganaLevelCodes.push ({
    "kya" : "きゃ",
    "kyu" : "きゅ",
    "kyo" : "きょ",
    "gya" : "ぎゃ",
    "gyu" : "ぎゅ",
    "gyo" : "ぎょ",
    "sha" : "しゃ",
    "shu" : "しゅ",
    "sho" : "しょ",
    "ja" : "じゃ",
    "ju" : "じゅ",
    "jo" : "じょ",
    "cha" : "ちゃ",
    "chu" : "ちゅ",
    "cho" : "ちょ",
    "dzya" : "ぢゃ",
    "dzyu" : "ぢゅ",
    "dzyo" : "ぢょ",
    "nya" : "にゃ",
    "nyu" : "にゅ",
    "nyo" : "にょ",
    "hya" : "ひゃ",
    "hyu" : "ひゅ",
    "hyo" : "ひょ",
    "bya" : "びゃ",
    "byu" : "びゅ",
    "byo" : "びょ",
    "pya" : "ぴゃ",
    "pyu" : "ぴゅ",
    "pyo" : "ぴょ",
    "mya" : "みゃ",
    "myu" : "みゅ",
    "myo" : "みょ",
    "rya" : "りゃ",
    "ryu" : "りゅ",
    "ryo" : "りょ"
  });

  // Level 12  - additional symbols
  _hiraganaLevelCodes.push ({
    "wi" : "ゐ",
    "we" : "ゑ",
    "vu" : "ゔ"
  });

  // create an object with all hiragana symbols
  for (i=0; i<_hiraganaLevelCodes.length; i++) {
    _hiraganaCodes = collect (_hiraganaCodes, _hiraganaLevelCodes[i]);
  }


  // public functions
  this.getNumberOfLevels = function () {
    return _hiraganaLevelCodes.length;
  };

  this.getSymbolsFromLevel = function (level) {
    return _hiraganaLevelCodes[level];
  };

  this.getSymbol = function (text) {
    return _hiraganaCodes[text];
  };

  this.getText = function (symbol) {
    var text = Object.keys(_hiraganaCodes).filter(function(key) {return _hiraganaCodes[key] === symbol;})[0];
    return text;
  };

};
