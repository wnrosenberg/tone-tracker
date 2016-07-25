// Set up a keypress listener:
// http://dmauro.github.io/Keypress/
var keyer = new window.keypress.Listener();

/* DEFINE VARS */
var patterns = []; // Container for our patterns.
var o = {          // Set some options for our app.
  rows: 4,           // the number of rows per channel
  channels: 2        // the number of channels per pattern
};
var cp = 0;        // ID of the current pattern.
var ticks_per_quarternote = 4;
var keyboard_mode = "qwerty";



/* DEFINE METHODS */

// Generates an empty pattern with r rows and c channels
function generate_empty_pattern(r,c) {
  var channel = [], pattern = [], i = 0, j = 0;
  // Fill the channel with empty rows.
  while ( i < r ) {
    channel.push(["...",".."," ..","..."]); i++;
  }
  // Fill the pattern with empty channels.
  while ( j < c ) {
    pattern.push( channel.slice(0) ); j++;
  } 
  return pattern;
}

// Displays pattern data
function display_pattern(pid) {
  var $pattern = $("#pattern");
  
  $pattern.find('.row');

  console.log(patterns);
}


/* INITIALIZATION */

// Start by pushing a new, empty pattern to the patterns list.
//patterns.push( generate_empty_pattern(o.rows,o.channels) );

// Then display that pattern on the front-end.
//display_pattern( cp );

function update_transport_stats() {
  var $x = $(".transport-container"); // x-port container -> xpc -> x
  $x.find('.status span').text(Tone.Transport.state);
  var pos = Tone.Transport.position.split(':');
  $x.find('.measure input').val(pos[0]);
  $x.find('.beat input').val(pos[1]);
  $x.find('.tick input').val(Tone.Transport.ticks);
}

function highlight_current_row() {

  // @TODO: Time Signature should be a function of lines.

  // Get the number of lines:
  var numlines = $("#pattern").find(".row:last-child").data('line') + 1;
  
  // Get the current number of ticks.
  var curticks = Tone.Transport.ticks;

  // use modulus to loop ticks over the pattern
  var curline = curticks % numlines;
  var prevline = (numlines + (curline - 1)) % numlines;

  $("#pattern").find(".row[data-line="+prevline+"]").removeClass('highlighted');
  $("#pattern").find(".row[data-line="+curline+"]").addClass('highlighted')

}

$(function(){

  // Init
  //new Tone;

  // 1 measure = 16 lines
  // 1 quarternote = 4 lines
  
  Tone.Transport.PPQ = ticks_per_quarternote;

  // On init, update stats.
  update_transport_stats();

  // On each tick, update the stats.
  Tone.Transport.scheduleRepeat(function(t){
    update_transport_stats();
    highlight_current_row();
  },'1i');

  // LISTEN FOR KEYPRESS EVENTS
  if (keyboard_mode == "qwerty") {
    keyer.simple_combo("s",function(){
      // When the S key is hit... 
    });
  }
  // $('.transport-container .key span').text();

  // Since the Tone.Transport automatically starts on
  // initialization, output the contents here.
  console.log("BPM: ", Tone.Transport.bpm.value);
  console.log("Loops: ", (Tone.Transport.loop ? "Yes" : "No"));
  console.log("Time Sig (x / 4): ", Tone.Transport.timeSignature);
  console.log("Position: ", Tone.Transport.position);
  console.log("PPQ: ", Tone.Transport.PPQ);
  Tone.Transport.on('start',function(e){ console.log('event start fired: ',e) });
  Tone.Transport.on('stop', function(e){ console.log('event stop fired: ' ,e) });
  Tone.Transport.on('pause',function(e){ console.log('event pause fired: ',e) });
  Tone.Transport.on('loop', function(e){ console.log('event loop fired: ' ,e) });

  // Setup handlers for UI buttons
  $(".transport-container .play").on('click', function(){
    Tone.Transport.start();
  });
  $(".transport-container .pause").on('click', function(){
    Tone.Transport.stop();
  });
  $(".order-container .add").on('click', function(){
    console.log("Add pattern button clicked!");
  });



});