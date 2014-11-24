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


// init the audio demo on osc_piano.php
function osc_piano_init() {
	$(document).bind('keydown', function(e){
		switch (e.which) {
			case 65:
				$("#pianokeys .key[data-keyboard=A]").addClass('active');
				break;

			case 87:
				$("#pianokeys .key[data-keyboard=W]").addClass('active');
				break;

			case 83:
				$("#pianokeys .key[data-keyboard=S]").addClass('active');
				break;

			case 69:
				$("#pianokeys .key[data-keyboard=E]").addClass('active');
				break;

			case 68:
				$("#pianokeys .key[data-keyboard=D]").addClass('active');
				break;

			case 70:
				$("#pianokeys .key[data-keyboard=F]").addClass('active');
				break;

			case 84:
				$("#pianokeys .key[data-keyboard=T]").addClass('active');
				break;

			case 71:
				$("#pianokeys .key[data-keyboard=G]").addClass('active');
				break;

			case 89:
				$("#pianokeys .key[data-keyboard=Y]").addClass('active');
				break;

			case 72:
				$("#pianokeys .key[data-keyboard=H]").addClass('active');
				break;

			case 85:
				$("#pianokeys .key[data-keyboard=U]").addClass('active');
				break;

			case 74:
				$("#pianokeys .key[data-keyboard=J]").addClass('active');
				break;

			case 75:
				$("#pianokeys .key[data-keyboard=K]").addClass('active');
				break;

			case 79:
				$("#pianokeys .key[data-keyboard=O]").addClass('active');
				break;

			case 76:
				$("#pianokeys .key[data-keyboard=L]").addClass('active');
				break;

			case 81:
				$("#pianokeys .key[data-keyboard=P]").addClass('active');
				break;

			case 186:
				$("#pianokeys .key:last-child").addClass('active');
				break;
		}
	});
	$(document).bind('keyup', function(e){
		switch (e.which) {
			case 65:
				$("#pianokeys .key[data-keyboard=A]").removeClass('active');
				break;

			case 87:
				$("#pianokeys .key[data-keyboard=W]").removeClass('active');
				break;

			case 83:
				$("#pianokeys .key[data-keyboard=S]").removeClass('active');
				break;

			case 69:
				$("#pianokeys .key[data-keyboard=E]").removeClass('active');
				break;

			case 68:
				$("#pianokeys .key[data-keyboard=D]").removeClass('active');
				break;

			case 70:
				$("#pianokeys .key[data-keyboard=F]").removeClass('active');
				break;

			case 84:
				$("#pianokeys .key[data-keyboard=T]").removeClass('active');
				break;

			case 71:
				$("#pianokeys .key[data-keyboard=G]").removeClass('active');
				break;

			case 89:
				$("#pianokeys .key[data-keyboard=Y]").removeClass('active');
				break;

			case 72:
				$("#pianokeys .key[data-keyboard=H]").removeClass('active');
				break;

			case 85:
				$("#pianokeys .key[data-keyboard=U]").removeClass('active');
				break;

			case 74:
				$("#pianokeys .key[data-keyboard=J]").removeClass('active');
				break;

			case 75:
				$("#pianokeys .key[data-keyboard=K]").removeClass('active');
				break;

			case 79:
				$("#pianokeys .key[data-keyboard=O]").removeClass('active');
				break;

			case 76:
				$("#pianokeys .key[data-keyboard=L]").removeClass('active');
				break;

			case 81:
				$("#pianokeys .key[data-keyboard=P]").removeClass('active');
				break;

			case 186:
				$("#pianokeys .key:last-child").removeClass('active');
				break;
		}
	});

	$("#pianokeys .key").on("keydown mousedown", function(){
		$(this).addClass("active");
	}).on("keyup mouseup", function(){
		$(this).removeClass("active");
	}).each(function(){
		$this = $(this);
		if ($this.data('note').indexOf("#") != -1) {
			// Raise sharps
			$this.addClass("sharp");
		}
		if ($this.data('note').indexOf("9") != -1) {
			// Invalid octave
			$this.addClass("invalid");
		}
		$('<span class="note"></span>').text($this.data("note")).appendTo($this);
	});

}

// ------- HELPER FUNCTIONS ---------

function math_get_frequency_from_note(note) {
	// is the note in separate vars?
	if ($octave !== false) {
		// $note   = "[A-G]{1}[-#]{1}?"
		// $octave = "[0-8]{1}"
	} else {
		// $note   = "[A-G]{1}[-#]{1}[0-8]{1}"
	}
	// How many notes away from A-4 is this note?
	$freq = (440 * 2^(n/12));
}





