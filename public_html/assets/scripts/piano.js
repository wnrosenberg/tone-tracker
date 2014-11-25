// Define an audio context.
var audioCtx = new (window.AudioContext || window.webkitAudioContext)();

// Define master gain.
var outputNode = audioCtx.createGain();
outputNode.gain.value = 0.75; // start at 75% volume.
outputNode.connect(audioCtx.destination); // connect to speakers

// Define our piano object.
var piano = {
	frequencies : {
		"C-0":16.35  ,"C#0":17.32  ,"D-0":18.35  ,"D#0":19.45  ,"E-0":20.60  ,"F-0":21.83  ,"F#0":23.12  ,"G-0":24.50  ,"G#0":25.96  ,"A-0":27.50  ,"A#0":29.14  ,"B-0":30.87  ,
		"C-1":32.70  ,"C#1":34.65  ,"D-1":36.71  ,"D#1":38.89  ,"E-1":41.20  ,"F-1":43.65  ,"F#1":46.25  ,"G-1":49.00  ,"G#1":51.91  ,"A-1":55.00  ,"A#1":58.27  ,"B-1":61.74  ,
		"C-2":65.41  ,"C#2":69.30  ,"D-2":73.42  ,"D#2":77.78  ,"E-2":82.41  ,"F-2":87.31  ,"F#2":92.50  ,"G-2":98.00  ,"G#2":103.83 ,"A-2":110.00 ,"A#2":116.54 ,"B-2":123.47 ,
		"C-3":130.81 ,"C#3":138.59 ,"D-3":146.83 ,"D#3":155.56 ,"E-3":164.81 ,"F-3":174.61 ,"F#3":185.00 ,"G-3":196.00 ,"G#3":207.65 ,"A-3":220.00 ,"A#3":233.08 ,"B-3":246.94 ,
		"C-4":261.63 ,"C#4":277.18 ,"D-4":293.66 ,"D#4":311.13 ,"E-4":329.63 ,"F-4":349.23 ,"F#4":369.99 ,"G-4":392.00 ,"G#4":415.30 ,"A-4":440.00 ,"A#4":466.16 ,"B-4":493.88 ,
		"C-5":523.25 ,"C#5":554.37 ,"D-5":587.33 ,"D#5":622.25 ,"E-5":659.25 ,"F-5":698.46 ,"F#5":739.99 ,"G-5":783.99 ,"G#5":830.61 ,"A-5":880.00 ,"A#5":932.33 ,"B-5":987.77 ,
		"C-6":1046.50,"C#6":1108.73,"D-6":1174.66,"D#6":1244.51,"E-6":1318.51,"F-6":1396.91,"F#6":1479.98,"G-6":1567.98,"G#6":1661.22,"A-6":1760.00,"A#6":1864.66,"B-6":1975.53,
		"C-7":2093.00,"C#7":2217.46,"D-7":2349.32,"D#7":2489.02,"E-7":2637.02,"F-7":2793.83,"F#7":2959.96,"G-7":3135.96,"G#7":3322.44,"A-7":3520.00,"A#7":3729.31,"B-7":3951.07,
		"C-8":4186.01,"C#8":4434.92,"D-8":4698.63,"D#8":4978.03,"E-8":5274.04,"F-8":5587.65,"F#8":5919.91,"G-8":6271.93,"G#8":6644.88,"A-8":7040.00,"A#8":7458.62,"B-8":7902.13
	},
	keyboard_keys : {
		/* Standard Keys */
		65:"[data-keyboard=A]",87:"[data-keyboard=W]",83:"[data-keyboard=S]",69:"[data-keyboard=E]",
		68:"[data-keyboard=D]",70:"[data-keyboard=F]",84:"[data-keyboard=T]",71:"[data-keyboard=G]",
		89:"[data-keyboard=Y]",72:"[data-keyboard=H]",85:"[data-keyboard=U]",74:"[data-keyboard=J]",
		75:"[data-keyboard=K]",79:"[data-keyboard=O]",76:"[data-keyboard=L]",80:"[data-keyboard=P]",
		186:"[data-keyname=colon]"
		/* Ghost Keys */
		// ,81:"[data-keyboard=Q]",82:"[data-keyboard=R]",73:"[data-keyboard=I]"
	},
	tones : {
		// array of "tones" oscillator nodes currently playing.
	}
}

window.onload = function() {
	osc_piano_init();
}


// Piano Initialisation
function osc_piano_init() {

	// Handle ASCII keypress
	$(document).bind('keydown', function(e){
		return piano_trigger_keypress(e, "on");
	}).bind('keyup', function(e){
		return piano_trigger_keypress(e, "off");
	});

	// Handle Mouse and Touch events.
	$("#pianokeys .key").on("mousedown", function(){
		return piano_trigger_key($(this), "on");
	}).on("mouseup", function(){
		return piano_trigger_key($(this), "off");
	});

	// Draw key according to its data attribs.
	$("#pianokeys .key").each(function(){
		return piano_draw_key($(this));
	});

	// Handle Master Volume control
	$("#gvol").on("change",function(){
		// When the frequency slider is changed:
		var $this = $(this);
		
		// Update the oscillator's value.
		var val = outputNode.gain.value = $this.val();
		
		// And display its value.
		var $disp = $this.parents("label").siblings(".range_value");
		var poz = $disp.data('round'); /* rounding position */

		// Round new_value to val_disp_round position.
		$disp.val( Math.round( val * 1/poz ) * poz );
	});

}

// Draws the face of the key and assigns appropriate classes.
// Note: argument is a jQuery object.
function piano_draw_key($key) {
	// @TODO: validate that it is a jquery object and convert it if necessary.
	if ($key.data('note').indexOf("#") != -1) {
		// Raise sharps
		$key.addClass("sharp");
	} else {
		// maybe a sharp is left over from a previous layout.
		$key.removeClass("sharp");
	}
	if ($key.data('note').indexOf("9") != -1) {
		// Invalid octave
		$key.addClass("invalid");
	} else {
		// maybe the octave is shifted down and this key becomes valid again.
		$key.removeClass("invalid");
	}
	$('<span class="note"></span>').text($key.data("note")).appendTo($key);
	return;
}


// Map the keypress events to an object, and then run piano_trigger_key(object).
function piano_trigger_keypress(e, active) {
	// Map the keyboard key's ascii value to its corresponding piano key.
	if (in_array(e.which, Object.keys(piano.keyboard_keys))) {
		selector = "#pianokeys .key" + piano.keyboard_keys[e.which];
		return piano_trigger_key($(selector),active);
	} else {
		console.log("Invalid key pressed: " + e.which);
		return false;
	}
}

// Calls the piano_note_on or piano_note_off functions for a given key.
// Note: argument is a jQuery object.
function piano_trigger_key($key, active) {
	var the_note = $key.data('note');

	if (active == "on") {
		// Is this key already pressed?
		if (typeof piano.tones[the_note] !== 'undefined') return; 

		$key.addClass('active');
		piano_note_on(the_note);
	} else if (active == "off") {
		$key.removeClass('active');
		piano_note_off(the_note);
	} else {
		// goggles
	}
}

function piano_note_on(note) {
	// @TODO what if there's a note already playing at this address?
	// if (piano.tones[note]) return error.alreadyPlaying;
	console.log("Note On: " + note);

	// Create a new oscillator node and set it to this note's frequency.
	piano.tones[note] = audioCtx.createOscillator();
	piano.tones[note].type = 0;
	piano.tones[note].frequency.value = math_get_frequency_from_note(note);

	// Start it!
	piano.tones[note].start(0);

	// Connect it to the OUTPUT
	piano.tones[note].connect(outputNode);
}

function piano_note_off(note) {
	console.log("Note Off: " + note);
	// Stop this node.
	piano.tones[note].stop(0);
	// Disconnect this node.
	piano.tones[note].disconnect();
	// And remove it from the array.
	delete piano.tones[note];
}

function math_get_frequency_from_note(note) {
	
	// @TODO: USE MATH
	// How many notes away from A-4 is this note?
	//$freq = (440 * 2^(n/12));

	// For now doe lets use piano.frequencies[note];
	return piano.frequencies[note];
}