<?php #><?js


/**
 * Define pattern constructor
 * @param object options initialization options
 */
var Pattern = function(options) {

  // Setting overrides
  this.options = options;

  // Settings which can be overrided by $options:
  this.defaults = {
    /* Pattern dimensions */
         "channels": 4      , // Number of channels in the pattern (or layers in the banner)
             "rows": "auto" , // Integer, Keyword, Function:
                  // integer:    explicit number, overrides time-based measurements
                  // "duration": calculate( bpm/60 * tpb * patternLength ) (120/60*4*15=120)
                  // "auto":     use "duration"
                  // function(): returns an integer, may use time-based measurements

    /* Time-based measurements */
    "patternLength": 15.0   , // integer, float, or string for length of pattern (see below)
                  // integer: number of ms (15000 = 15s)
                  // float:   number of seconds (15.2 = 15.2s)
                  // string:  Tone.JS-formatted time string or expression ("15" = (4n * 15) = "120i")
              "bpm": 120    , // Beats per minute (120 bpm = 2 beats per second)
              "tpb": 4      , // Ticks per beat (4tpb @ 120bpm = 8 ticks per second)
      "useMeasures": false  , // Whether to use traditional measures, or just have all beats in one measure
    "measureLength": 4      , // Number of beats in a measure, if useMeasures==true

    /* Stage Details */
         "useStage": true   , // Whether to use a stage
       "stageWidth": 300    , // Width of the stage in px
      "stageHeight": 250    , // Height of the stage in px

    /* UI settings */
        "highlight": false //,// row highlighting (see below)
                  // boolean: true = "onBoth", false = none
                  // string:  "onBeats", "onMeasures", "onBoth", "none" or ""
                  // object:  {type:'onBoth',beatCSS:{},measureCSS:{}}
  };

  this.settings = {};

  for (var prop in this.defaults) {
    if( obj.hasOwnProperty( prop ) ) {
      console.log("obj." + prop + " = " + obj[prop]);
    } 
  }

  function 


  /**
   * Generates an empty pattern with r rows and c channels
   * @param  integer r number of rows
   * @param  integer c number of channels
   * @return object    pattern data
   */
  function generate_empty_pattern(r,c) {
    var row = [], pattern = [], i = 0, j = 0;

    // Fill the row with columns.
    while ( i < c ) {
      row.push(["...",".."," ..","..."]); i++;
    }

    // Fill the pattern with empty channels.
    while ( j < r ) {
      pattern.push( row.slice(0) ); j++;
    } 
    return pattern;
  }

  var data = generate_empty_pattern(this.settings.rows, );
  // rows: cols: eventdata
  //   0: {
  //     0: ["...",".."," ..","..."],
  //     1: ["...",".."," ..","..."],
  //     2: ["...",".."," ..","..."],
  //     3: ["...",".."," ..","..."]
  //   },
  //   1: {
  //     0: ["...",".."," ..","..."],
  //     1: ["...",".."," ..","..."],
  //     2: ["...",".."," ..","..."],
  //     3: ["...",".."," ..","..."]
  //   },
  //   2: {
  //     0: ["...",".."," ..","..."],
  //     1: ["...",".."," ..","..."],
  //     2: ["...",".."," ..","..."],
  //     3: ["...",".."," ..","..."]
  //   },
  //   3: {
  //     0: ["...",".."," ..","..."],
  //     1: ["...",".."," ..","..."],
  //     2: ["...",".."," ..","..."],
  //     3: ["...",".."," ..","..."]
  //   },
  // };

  var get

}


/** 
 
Pattern.prototype = {
  constructor: Pattern,
  functionName: function(variable) {
    this.localvar = "value";
  },
  anotherFunc: function(variable2) {

  }
}

// Use it!
var page = new Pattern({
  "rows": 64,
  "channels": 4
});

page.functionName("a string");

 */
