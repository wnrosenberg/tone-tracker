// init the audio demo on basico.php
function basico_init() {

	// Define an audio context.
	var audioCtx = new (window.AudioContext || window.webkitAudioContext)();

	// Define an audio source node (in this case, an oscillator).
	var oscillator = audioCtx.createOscillator();

	// Define an effect node (in this case, a gain (volume) control).
	var gainNode = audioCtx.createGain();

	// Define an audio output node (by default, speakers).
	var speakers = audioCtx.destination;

	// Connect the component nodes.
	oscillator.connect(gainNode);
	gainNode.connect(speakers);

	// Set options for the oscillator.
	oscillator.type = 0; // sine wave
	oscillator.frequency.value = 440; // value in hertz

}

// init the audio demo on basico_ui.php
function basico_ui_init() {

	// Define an audio context.
	var audioCtx = new (window.AudioContext || window.webkitAudioContext)();

	// Define an audio source node (in this case, an oscillator).
	var oscillator = audioCtx.createOscillator();
	var o_playing = false;
	// Set options for the oscillator.
	oscillator.type = 0; // sine wave
	oscillator.frequency.value = 440; // value in hertz

	// Define an effect node (in this case, a gain (volume) control).
	var gainNode = audioCtx.createGain();
	// Set options for the gain.
	gainNode.gain.value = 0.5; // start at half volume.

	// Define the last node in our sequence.
	var lastAudioNode = gainNode;

	// Define an audio output node (by default, speakers).
	var speakers = audioCtx.destination;

	// Connect the source to the effect.
	oscillator.connect(gainNode);
	// Don't connect the lastAudioNode to the speakers yet.
	//lastAudioNode.connect(speakers);

	// ----------------------------------------------

	// Connect UI elements to their Audio Nodes
	$("#start").on("click",function(){
		if (!o_playing) {
			// start playing (connect)
			lastAudioNode.connect(speakers);
			o_playing = true;
		}
	});
	$("#stop").on("click",function(){
		if (o_playing) {
			// stop playing (disconnect)
			lastAudioNode.disconnect();
			o_playing = false;
		}
	});

	$("#ofreq").on("change",function(){
		// When the frequency slider is changed:
		var $this = $(this);
		
		// Update the oscillator's value.
		var val = oscillator.frequency.value = $this.val();
		
		// And display its value.
		var $disp = $this.parents("label").siblings(".range_value");
		var poz = $disp.data('round'); /* rounding position */

		// Round new_value to val_disp_round position.
		$disp.val( Math.round( val * 1/poz ) * poz );
	});

	$("#gvol").on("change",function(){
		// When the frequency slider is changed:
		var $this = $(this);
		
		// Update the oscillator's value.
		var val = gainNode.gain.value = $this.val();
		
		// And display its value.
		var $disp = $this.parents("label").siblings(".range_value");
		var poz = $disp.data('round'); /* rounding position */

		// Round new_value to val_disp_round position.
		$disp.val( Math.round( val * 1/poz ) * poz );
	});

	// ---------------------------------------

	// Start the oscillator: 
	oscillator.start();


}


/* -------- PHPJS -------- */
function in_array(needle, haystack, argStrict) {
  //  discuss at: http://phpjs.org/functions/in_array/
  var key = '', strict = !! argStrict;
  if (strict) {
    for (key in haystack){ if (haystack[key] === needle){ return true; }}
  } else {
    for (key in haystack){ if (haystack[key] == needle){ return true; }}
  }
  return false;
}
