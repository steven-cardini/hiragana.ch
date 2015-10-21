var KatakanaHandler = function () {

  // private instance variables
  var _katakanaCodes = [];
  var _katakanaLevelCodes = [];
  var i = 0;

  // private functions
  var collect = function () {
    var ret = {};
    var len = arguments.length;
    for (var i=0; i<len; i++) {
      for (p in arguments[i]) {
        if (arguments[i].hasOwnProperty(p)) {
          ret[p] = arguments[i][p];
        }
      }
    }
    return ret;
  };

  // constructor
  // Level 0
  _katakanaLevelCodes.push ({
    "a" : "ア",
    "i" : "イ",
    "u" : "ウ",
    "e" : "エ",
    "o" : "オ"
  });

  // Level 1
  _katakanaLevelCodes.push ({
    "ka" : "カ",
    "ki" : "キ",
    "ku" : "ク",
    "ke" : "ケ",
    "ko" : "コ"
  });

  // Level 2
  _katakanaLevelCodes.push ({
    "sa" : "サ",
    "shi" : "シ",
    "su" : "ス",
    "se" : "セ",
    "so" : "ソ"
  });

  // Level 3
  _katakanaLevelCodes.push ({
    "ta" : "タ",
    "chi" : "チ",
    "tsu" : "ツ",
    "te" : "テ",
    "to" : "ト"
  });

  // Level 4
  _katakanaLevelCodes.push ({
    "na" : "ナ",
    "ni" : "ニ",
    "nu" : "ヌ",
    "ne" : "ネ",
    "no" : "ノ"
  });

  // Level 5
  _katakanaLevelCodes.push ({
    "ha" : "ハ",
    "hi" : "ヒ",
    "fu" : "フ",
    "he" : "ヘ",
    "ho" : "ホ"
  });

  // Level 6
  _katakanaLevelCodes.push ({
    "ma" : "マ",
    "mi" : "ミ",
    "mu" : "ム",
    "me" : "メ",
    "mo" : "モ"
  });

  // Level 7
  _katakanaLevelCodes.push ({
    "ya" : "ヤ",
    "yu" : "ユ",
    "yo" : "ヨ"
  });

  // Level 8
  _katakanaLevelCodes.push ({
    "ra" : "ラ",
    "ri" : "リ",
    "ru" : "ル",
    "re" : "レ",
    "ro" : "ロ"
  });

  // Level 9
  _katakanaLevelCodes.push ({
    "wa" : "ワ",
    "wo" : "ヲ",
    "n" : "ン"
  });

  // Level 10 - dakuten
  _katakanaLevelCodes.push ({
    "ga" : "ガ",
    "gi" : "ギ",
    "gu" : "グ",
    "ge" : "ゲ",
    "go" : "ゴ",
    "za" : "ザ",
    "ji" : "ジ",
    "zu" : "ズ",
    "ze" : "ゼ",
    "zo" : "ゾ",
    "da" : "ダ",
    "dzi" : "ヂ",
    "dzu" : "ヅ",
    "de" : "デ",
    "do" : "ド",
    "ba" : "バ",
    "bi" : "ビ",
    "bu" : "ブ",
    "be" : "ベ",
    "bo" : "ボ",
    "pa" : "パ",
    "pi" : "ピ",
    "pu" : "プ",
    "pe" : "ペ",
    "po" : "ポ"
  });

  // Level 11 - digraphs
  _katakanaLevelCodes.push ({
    "kya" : "キャ",
    "kyu" : "キュ",
    "kyo" : "キョ",
    "gya" : "ギャ",
    "gyu" : "ギュ",
    "gyo" : "ギョ",
    "sha" : "シャ",
    "shu" : "シュ",
    "sho" : "ショ",
    "ja" : "ヂャ",
    "ju" : "ヂュ",
    "jo" : "ヂョ",
    "cha" : "チャ",
    "chu" : "チュ",
    "cho" : "チョ",
    "dzya" : "ヂャ",
    "dzyu" : "ヂュ",
    "dzyo" : "ヂョ",
    "nya" : "ニャ",
    "nyu" : "ニュ",
    "nyo" : "ニョ",
    "hya" : "ヒャ",
    "hyu" : "ヒュ",
    "hyo" : "ヒョ",
    "bya" : "ビャ",
    "byu" : "ビュ",
    "byo" : "ビョ",
    "pya" : "ピャ",
    "pyu" : "ピュ",
    "pyo" : "ピョ",
    "mya" : "ミャ",
    "myu" : "ミュ",
    "myo" : "ミョ",
    "rya" : "リャ",
    "ryu" : "リュ",
    "ryo" : "リョ"
  });

  // Level 12  - additional symbols
  _katakanaLevelCodes.push ({
    "wi" : "ヰ",
    "we" : "ヱ"
  });

  // create an object with all katakana symbols
  for (i=0; i<_katakanaLevelCodes.length; i++) {
    _katakanaCodes = collect (_katakanaCodes, _katakanaLevelCodes[i]);
  }


  // public functions
  this.getNumberOfLevels = function () {
    return _katakanaLevelCodes.length;
  };

  this.getSymbolsFromLevel = function (level) {
    return _katakanaLevelCodes[level];
  };

  this.getSymbol = function (text) {
    console.log ("getSymbol("+text+")="+_katakanaCodes[text]);
    return _katakanaCodes[text];
  };

  this.getText = function (symbol) {
    var text = Object.keys(_katakanaCodes).filter(function(key) {return _katakanaCodes[key] === symbol})[0];
    return text;
  };

};
