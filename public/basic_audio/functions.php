<?

error_reporting(E_ALL);



function isset_notempty(&$var) {
	return (isset($var) && !empty($var));
}

#Source: http://www.phy.mtu.edu/~suits/notefreqs.html
$key_frequencies = array(
	"C-0" => 16.35   , "C#0" => 17.32   , "D-0" => 18.35   , "D#0" => 19.45   , "E-0" => 20.60   , "F-0" => 21.83   , "F#0" => 23.12   , "G-0" => 24.50   , "G#0" => 25.96   , "A-0" => 27.50   , "A#0" => 29.14   , "B-0" => 30.87   ,
	"C-1" => 32.70   , "C#1" => 34.65   , "D-1" => 36.71   , "D#1" => 38.89   , "E-1" => 41.20   , "F-1" => 43.65   , "F#1" => 46.25   , "G-1" => 49.00   , "G#1" => 51.91   , "A-1" => 55.00   , "A#1" => 58.27   , "B-1" => 61.74   , 
	"C-2" => 65.41   , "C#2" => 69.30   , "D-2" => 73.42   , "D#2" => 77.78   , "E-2" => 82.41   , "F-2" => 87.31   , "F#2" => 92.50   , "G-2" => 98.00   , "G#2" => 103.83  , "A-2" => 110.00  , "A#2" => 116.54  , "B-2" => 123.47  , 
	"C-3" => 130.81  , "C#3" => 138.59  , "D-3" => 146.83  , "D#3" => 155.56  , "E-3" => 164.81  , "F-3" => 174.61  , "F#3" => 185.00  , "G-3" => 196.00  , "G#3" => 207.65  , "A-3" => 220.00  , "A#3" => 233.08  , "B-3" => 246.94  , 
	"C-4" => 261.63  , "C#4" => 277.18  , "D-4" => 293.66  , "D#4" => 311.13  , "E-4" => 329.63  , "F-4" => 349.23  , "F#4" => 369.99  , "G-4" => 392.00  , "G#4" => 415.30  , "A-4" => 440.00  , "A#4" => 466.16  , "B-4" => 493.88  , 
	"C-5" => 523.25  , "C#5" => 554.37  , "D-5" => 587.33  , "D#5" => 622.25  , "E-5" => 659.25  , "F-5" => 698.46  , "F#5" => 739.99  , "G-5" => 783.99  , "G#5" => 830.61  , "A-5" => 880.00  , "A#5" => 932.33  , "B-5" => 987.77  , 
	"C-6" => 1046.50 , "C#6" => 1108.73 , "D-6" => 1174.66 , "D#6" => 1244.51 , "E-6" => 1318.51 , "F-6" => 1396.91 , "F#6" => 1479.98 , "G-6" => 1567.98 , "G#6" => 1661.22 , "A-6" => 1760.00 , "A#6" => 1864.66 , "B-6" => 1975.53 , 
	"C-7" => 2093.00 , "C#7" => 2217.46 , "D-7" => 2349.32 , "D#7" => 2489.02 , "E-7" => 2637.02 , "F-7" => 2793.83 , "F#7" => 2959.96 , "G-7" => 3135.96 , "G#7" => 3322.44 , "A-7" => 3520.00 , "A#7" => 3729.31 , "B-7" => 3951.07 , 
	"C-8" => 4186.01 , "C#8" => 4434.92 , "D-8" => 4698.63 , "D#8" => 4978.03 , "E-8" => 5274.04 , "F-8" => 5587.65 , "F#8" => 5919.91 , "G-8" => 6271.93 , "G#8" => 6644.88 , "A-8" => 7040.00 , "A#8" => 7458.62 , "B-8" => 7902.13
);



function math_get_frequency_from_note($note) {
	if (is_array($note)) {
		$note_info = $note;
	} else {
		if(!is_note_valid($note,$note_info)) {
			return false;
		}
	}

	$note_info = normalize_note($note_info);
	list($letter, $modifier, $octave) = $note_info;

	// How far away from A-4 is $note?
	if ($octave = 4) {
		// same octave!
	}
	
	// The steps for our util below.
	$steps = array("C-" , "C#" , "D-" , "D#" , "E-" , "F-" , "F#" , "G-" , "G#" , "A-" , "A#" , "B-");

	$n = 0; // number of steps.



	// how does this note data compare with A-4?
	if ($note_octave >=4) { // UP
		// how many octaves up is it?
		$octaves_up = $note_octave - 4;
		// how many notes away from A is it?
		$notes_up   = util_get_num_steps($letter.$modifier, "A-", $steps, 'up');
		$n = $octaves_up * 12 + $notes_up;
	} else { // DOWN
		// how many octaves down is it?
		$octaves_dn = 4 - $note_octave;
		// how many notes away from A is it?
		$notes_dn   = util_get_num_steps($letter.$modifier, "A-", $steps, 'down');
		$n = ($octaves_dn * 12 + $notes_dn) * -1;
	}

	// How many notes away from A-4 is this note?
	$freq = 440.0 * pow( 2 , $n / 12 );

	return $freq;
}

// Find $needle in array $haystack, starting with value $start, 
// moving in $direction ('up'/1 or 'down'/-1), and optionally, 
// of $type (which may cause some particular behavior in the future).
// Return values include: false (error), 0 to sizeof($haystack)-1.
// If $type != false, 
function util_get_num_steps($needle, $start, $haystack, $direction, $type=false) {

	// dim a var to hold our count
	$count = 0;

	// start with some validation:
	if (!is_array($haystack) || !in_array($start, $haystack) || !in_array($needle, $haystack)) {
		// failed basic validation :(
		return false;
	} else if ($needle == $start) {
		// its the same! posititon = 0
		return $count;
	} else if (!in_array($direction,array('up',1,'down',-1))) {
		// invalid direction value :(
		return false;
	}

	//
	// -- HEAD --
	// 

	//echo "ORIGINAL NOTES: " . implode(", ", $the_notes) . "\n";
	foreach ($the_notes as $the_note) {
		// Is this note valid?
		if (is_note_valid($the_note,$note_info)) {
			$new_notes[] = implode("",normalize_note($note_info));
		} else {
			$new_notes[] = "---";
		}
	}
	//echo "THE NEW NOTES: " . implode(", ", $new_notes) . "\n";

	//
	// -- MERGED --
	// 

	// set $direction to an integer
	$direction = -1;
	if (in_array($direction, array('up',1))) {
		$direction = 1;
	}

	//
	// -- END --
	// 

	// time to count!  first reset $haystack's keys
	$haystack = array_values($haystack);

	// then get the index of $start in $haystack
	$current_pos = array_search($start);

	// find $needle, counting how long it takes.
	while($haystack[$current_pos] != $needle) {
		if ($count == sizeof($haystack) + 1) {
			// it wasn't found :(
			return false;
		}
		// ok, so $haystack[$current_pos] != $needle. cool. increase by one in the $direction 
		$current_pos = $current_pos + $direction;

		// but what if $current_pos is now outside the bounds of the array?
		if ($current_pos < 0) {
			// too low!
			$current_pos = sizeof($haystack)-1;
		} else if ($current_pos == sizeof($haystack)) {
			// too high, man!
			$current_pos = 0;
		}

		// and lastly update $count
		$count++;

	}

	// At last, return the count!
	return $count;
}

function is_note_valid($note, &$note_matches=false) {
	preg_match('/([A-G]{1})([-#b]{1})([0-8]{1})/i', $note, $note_matches);
	if (sizeof($note_matches) == 4) {
		// pop the first match off the array.
		array_shift($note_matches);
		return true;
	} else {
		return false;
	}
}

function get_note_parts($note) {
	preg_match('/([A-G]{1})([-#b]{1})([0-8]{1})/i', $note, $note_matches);
	if (sizeof($note_matches) == 4) {
		// pop the first match off the array.
		array_shift($note_matches);
		return $note_matches;
	} else {
		return false;
	}
}


function normalize_note($note_info) {
	
	if (sizeof($note_info == 3)) {
		// goggles fit perfectly
	} else if (sizeof($note_info == 4)) {
		// remove the first element.
		array_shift($note_info);
	} else {
		// invalid $note_info
		return false;
	}
	list($letter, $modifier, $octave) = $note_info;
	
	$map = array(
		// Convert Flats to Sharps/Naturals
		'Ab' => array( 'letter' => 'G', 'modifier' => '#', 'octave' => -1 ),
		'Bb' => array( 'letter' => 'A', 'modifier' => '#', 'octave' => 0  ),
		'Cb' => array( 'letter' => 'B', 'modifier' => '-', 'octave' => 0  ),
		'Db' => array( 'letter' => 'C', 'modifier' => '#', 'octave' => 0  ),
		'Eb' => array( 'letter' => 'D', 'modifier' => '#', 'octave' => 0  ),
		'Fb' => array( 'letter' => 'E', 'modifier' => '-', 'octave' => 0  ),
		'Gb' => array( 'letter' => 'F', 'modifier' => '#', 'octave' => 0  ),
		
		// Convert Sharps to Naturals
		'B#' => array( 'letter' => 'C', 'modifier' => '-', 'octave' => 0  ),
		'E#' => array( 'letter' => 'F', 'modifier' => '-', 'octave' => 0  ),
	);
	
	if (in_array($letter.$modifier,array_keys($map))) {
		$new_letter   = $map[$letter.$modifier]['letter'];
		$new_modifier = $map[$letter.$modifier]['modifier'];
		$new_octave   = $octave + $map[$letter.$modifier]['octave'];
		if ($new_octave < 0) $new_octave = 0; // otherwise Ab0 => G#-1 (invalid)
	} else {
		$new_letter   = $letter;
		$new_modifier = $modifier;
		$new_octave   = $octave;
	}
	
	return array($new_letter, $new_modifier, $new_octave);
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////

//
// -- HEAD --
// 

// $the_notes = array('A-4','Bb3','F#5','H-2','B-9','B#3','E#5','Cb4','Fb3');
// $new_notes = array();

/**
 * steps_between_notes calculates steps between two notes
 * @param $noteone # array of ($letter, $modifier, $octave)
 * @param $noteone # array of ($letter, $modifier, $octave)
 * If the params are passed as strings, return false and RTFM.
 * @todo accept string representation and convert to array.
 */
function steps_between_notes($noteone, $notetwo) {
	if (!is_array($noteone) || !is_array($notetwo)) {
		return false;
	}

	$one = $noteone[0].$noteone[1];
	$two = $notetwo[0].$notetwo[1];
}

//
// -- MERGED --
// 

// //////////////////////////////////////////////////////////////

// echo "ORIGINAL NOTES: " . implode(", ", $the_notes) . "\n";
// foreach ($the_notes as $the_note) {
// 	// Is this note valid?
// 	if (is_note_valid($the_note,$note_info)) {
// 		$new_notes[] = implode("",normalize_note($note_info));
// 	} else {
// 		$new_notes[] = "---";
// 	}
// }
// echo "THE NEW NOTES: " . implode(", ", $new_notes) . "\n";

// 
// -- END --
// 

// //////////////////////////////////////////////////////////////


/* */ // end of file