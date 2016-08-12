<?php

/**
 * PATTERNS.PHP
 * Pattern Order and Pattern Editor
 */

// @TODO: Make this a CLASS

// Initialize variables to an empty song with one empty pattern.
$patterns = [];
$options = [
  'pattern' => [
    'defaults' => [ "rows" => 64 , "channels" => 4 ]
  ],
];
$pattern_defaults = $options['pattern']['defaults'];
$current_pattern = 0; // The index of the pattern currently displayed.



/**
 * Parse the options, overriding defaults with non-empty values.
 * @param  array $defaults    A key-value list of default values for the options.
 * @param  array $options     A key-value list of values to override defaults.
 * @param  bool  $allow_empty Whether to allow empty values to override defaults. (default: false)
 * @param  bool  $passthrough Whether to allow options not in defaults to be returned. Must satisfy value of $allow_empty. (default: false)
 * @return array              The resulting key-value list.
 */
function parse_options($defaults, $options, $allow_empty = false, $passthrough = false) {
  
  $settings = []; // result set

  // Loop through defaults, checking for overrides, and assigning value to $settings.
  foreach ($defaults as $k => $v) {

    // key doesnt exist, or its value is empty when its not allowed to be --> use default
    if (!isset($options[$k]) || (isset($options[$k]) && empty($options[$k]) && !$allow_empty)) {
      $settings[$k] = $v;
    }
    // key exists and value is either not empty, or is empty and allowed to be empty --> use option
    else /*if (isset($options[$k]) && ((empty($options[$k]) && $allow_empty) || !empty($options[$k])))*/ {
      $settings[$k] = $options[$k];
    }

  }

  // If extra options should pass through, add acceptable values to the resulting array,
  if ($passthrough) {
    foreach ($options as $k => $v) {
      if (!isset($defaults[$k])) {
        if (!empty($v) && (empty($v) && $allow_empty)) { // if (is_acceptable)
          $settings[$k] = $v; 
        }
      }
    }
  }

  return $settings;
}


/**
 * Generates an empty pattern with $rows rows and $channels channels
 * @todo   Convert this into a constructor when this becomes a class.
 * @param  array $options Contains rows/channels dimensions for pattern.
 * @return array          The resulting pattern to be added to the $patterns array.
 */
function generate_empty_pattern($options=[]) {
  
  // Set some defaults, then override them from $options.
  $defaults = [ 'rows' => 64, 'channels' => 4 ]; // application default for new patterns
  extract(parse_options($defaults, $options)); // creates $rows and $channels

  // Generate!
  $pattern = [];
  for ($i = 0 ; $i < $rows ; $i++) {
    $row = [];
    for ($j = 0 ; $j < $channels ; $j++) {
      $row[$j] = ['','','',''];
    }
    $pattern[$i] = $row;
  }
  return $pattern;
}

/**
 * Render the display for this pattern.
 * @param  array  $pattern The pattern to display.
 * @param  int    $pid     The id of the pattern being displayed.
 * @param  bool   $returns Whether the method should return the code or just echo it. (default: false (echo))
 * @return varies          If $returns == true, returns a string of HTML code representing the pattern.
 */
function display_pattern($pattern, $pid, $returns = false) {

  $content = "\n"; $pid = intval($pid);
  $rows = sizeof($pattern); $channels = sizeof($pattern[0]);

  // Do top header row:
  $content .= '  <div class="row">'."\n";
  $content .= '    <div class="col select-all">#'.$pid.'</div>'."\n";
  for ($j = 0 ; $j < $channels; $j++) {
  $content .= '    <div class="col channel col-heading" data-channel="'.$j.'">Channel '. ($j + 1) .'</div>'."\n";
  }
  $content .= '  </div>'."\n";

  // Do the rest of the rows:
  for ($i = 0 ; $i < $rows; $i++) {
    $content .= '  <div class="row" data-line="'.$i.'">'."\n";
    $content .= '    <div class="col row-heading">'.$i.'</div>'."\n";
    for ($j = 0 ; $j < $channels; $j++) {
      $content .= '    <div class="col channel data" data-channel="'.$j.'">'."\n";
      $content .= '      <div class="note">'.      (empty($pattern[$i][$j][0]) ? "..." : $pattern[$i][$j][0]).'</div>'."\n";
      $content .= '      <div class="instrument">'.(empty($pattern[$i][$j][1]) ? ".."  : $pattern[$i][$j][1]).'</div>'."\n";
      $content .= '      <div class="volume">'.    (empty($pattern[$i][$j][2]) ? " .." : $pattern[$i][$j][2]).'</div>'."\n";
      $content .= '      <div class="effect">'.    (empty($pattern[$i][$j][3]) ? "..." : $pattern[$i][$j][3]).'</div>'."\n";
      $content .= '    </div>'."\n";
    }
    $content .= '  </div>'."\n";
  }

  // Output or return!
  if ($returns) { return $content; } else { echo $content; }

}

?><!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Pattern Editor</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>



<p>Patterns</p>

<p>Pattern Toolbar</p>
<div class="transport-container">
  <div class="status">Status: <span>Initial</span></div>
  <div class="position">Position:
    <div class="measure"><input></div> :
    <div class="beat"><input></div> :
    <div class="tick"><input></div>
  </div>
  <div class="controls">
    <button class="play"><span class="glyphicon glyphicon-play"></span></button>
    <button class="pause"><span class="glyphicon glyphicon-pause"></span></button>
  </div>
  <div class="key"> <span></span> </div>
</div>

<p>Pattern Order</p>
<div class="order-container">
  <ul>
    <!-- <li>0</li>
    <li class="selected">1</li>
    <li class="selected">0</li>
    <li class="selected current">2</li>
    <li>3</li>
    <li>1</li>
    <li>4</li>
    <li>5</li> -->
    <li class="add">+</li>
  </ul>
</div>

<p>Pattern Editor</p>

<div id="pattern" class="container-fluid">
<?php

  // INITIALIZATION
  // In this script, we just want to create a new pattern and display it.
  $pattern = generate_empty_pattern($pattern_defaults); /* new Pattern($pattern_defaults) */

  display_pattern($pattern, $current_pattern);

?>

</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/keypress-2.1.4.min.js"></script>
<script type="text/javascript" src="./js/Tone.min.js"></script>
<script type="text/javascript" src="./js/script.js"></script>
</body>
</html>
