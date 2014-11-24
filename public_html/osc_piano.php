<?php
	$page_title = "Basic Oscillator/Gain Demo";
	include("header.php");
?>
	<p>Oscillator + Piano Keys Demo</p>

	<p>User the piano keys below to play notes.</p>

	<fieldset id="pianokeys" class="clearfix">
		<legend>Piano Keys</legend>

		<div class="key" data-note="C-4" data-keyboard="A"></div>
		<div class="key" data-note="C#4" data-keyboard="W"></div>
		<div class="key" data-note="D-4" data-keyboard="S"></div>
		<div class="key" data-note="D#4" data-keyboard="E"></div>
		<div class="key" data-note="E-4" data-keyboard="D"></div>
		<div class="key" data-note="F-4" data-keyboard="F"></div>
		<div class="key" data-note="F#4" data-keyboard="T"></div>
		<div class="key" data-note="G-4" data-keyboard="G"></div>
		<div class="key" data-note="G#4" data-keyboard="Y"></div>
		<div class="key" data-note="A-4" data-keyboard="H"></div>
		<div class="key" data-note="A#4" data-keyboard="U"></div>
		<div class="key" data-note="B-4" data-keyboard="J"></div>
		<div class="key" data-note="C-5" data-keyboard="K"></div>
		<div class="key" data-note="C#5" data-keyboard="O"></div>
		<div class="key" data-note="D-5" data-keyboard="L"></div>
		<div class="key" data-note="D#5" data-keyboard="P"></div>
		<div class="key" data-note="E-5" data-keyboard=";"></div>

	</fieldset>

	<fieldset id="controls">
		<legend>Controls</legend>

		<div class="buttons">
			<button id="start">Connect Output</button>
			<button id="stop">Disconnect Output</button>
		</div>


		<fieldset>
			<legend>Oscillator [SOURCE]</legend>
			<figure class="icon">
				<img src="./assets/images/oscillator_icon.png">
			</figure>
			<div>
				<label><span>Frequency:</span> <input id="ofreq" type="range" value="440" min="220" max="880" step="36.6666666666666" /></label><input type="text" class="range_value" data-round="1" value="440" />
			</div>
		</fieldset>


		<fieldset>
			<legend>Gain [EFFECT]</legend>
			<figure class="icon">
				<img src="./assets/images/effects_icon.png">
			</figure>
			<div>
				<label><span>Volume:</span> <input id="gvol" type="range" value="0.50" min="0.00" max="1.00" step="0.05" /></label><input type="text" class="range_value" data-round=".01" value="0.50" />
			</div>
		</fieldset>

		<fieldset>
			<legend>Speakers [DESTINATION]</legend>
			<figure class="icon">
				<img src="./assets/images/speaker_icon.png">
			</figure>
			<div></div>
		</fieldset>
			


	</fieldset>
	
	<script type="text/javascript">
		window.onload = function() {
  			osc_piano_init();
		};
	</script>

<?php
	include("footer.php");

/* */ // end of file