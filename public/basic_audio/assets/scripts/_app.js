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




/* Handle Interface Items */
$(".tglbtn button").click(function(){ // Toggle button
	var $this = $(this);
	var $parent = $this.parents(".tglbtn");

	console.log("Toggle Button Clicked.");
	console.log($parent);

	// What sort of button is it?
	if (!$parent.data("affect-id") && $parent.data("cb-method")) {
		// Callback!
		console.log("Triggered js callback.");

		var cb = $parent.data("cb-method"); // the func to call
		var target = $parent.data("cb-target"); // the object to pass as an arg

		// cb:     "record_keys"
		// target: "piano"

		//if ()
		// if (an object called target exists) {
		//     if (a function called cb exists) {
		//         set target.callback = cb
		//     }
		// }




	}

	if ($parent.data("affect-id") && !$parent.data("callback")) {
		// DOM effect
		console.log("Triggered dom effect.");

		var affect_id = "#" + $parent.data("affect-id"); // id of element affected by this button
		var active_class = $parent.data("active-class"); // class to apply to this element.

		console.log("Element ID to be affected: " + affect_id);
		console.log($(affect_id));
		console.log("Class to be applied to the element: " + active_class);

		$parent.toggleClass('active');
		$(affect_id).toggleClass(active_class);

	}

	

});

if ($("#keypress_action").length) {

	var waiting_for_keypress = false;

	$("#start_waiting").on('click', function() {
		$(this).hide();
		$("#keypress_action .message").show();
		waiting_for_keypress = true;
	});

	$(document).on('keypress', function(e){
		// prevent default action on keypress.
	    if (e.preventDefault) {
	        e.preventDefault();
	    } else {
	        // internet explorer
	        e.returnValue = false;
	    }

		console.log("keypress!");console.log(e);

		if (waiting_for_keypress) {
			$("#keypress_action .display div").text(e.which);
			$("#keypress_action .message").hide();
			$("#start_waiting").show();
			waiting_for_keypress = false;
		}

		return false;
	});

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
