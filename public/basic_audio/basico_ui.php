<?php
	$page_title = "";
	include("header.php");
?>
	<p>Basic Oscillator with UI Demo</p>

	<p>Plays sine wave at 440Hz</p>
	<p>Sliders adjust oscillator frequency and gain value.</p>

	<fieldset id="controls">
		<legend>Controls</legend>

		<div class="buttons">
			<button id="start">Connect Output</button>
			<button id="stop">Disconnect Output</button>
		</div>


		<fieldset class="default">
			<legend>Oscillator [SOURCE]</legend>
			<figure class="icon">
				<img src="./assets/images/oscillator_icon.png">
			</figure>
			<div>
				<label><span>Frequency:</span> <input id="ofreq" type="range" value="440" min="220" max="880" step="36.6666666666666" /></label><input type="text" class="range_value" data-round="1" value="440" />
			</div>
		</fieldset>


		<fieldset class="default">
			<legend>Gain [EFFECT]</legend>
			<figure class="icon">
				<img src="./assets/images/effects_icon.png">
			</figure>
			<div>
				<label><span>Volume:</span> <input id="gvol" type="range" value="0.50" min="0.00" max="1.00" step="0.05" /></label><input type="text" class="range_value" data-round=".01" value="0.50" />
			</div>
		</fieldset>

		<fieldset class="default">
			<legend>Speakers [DESTINATION]</legend>
			<figure class="icon">
				<img src="./assets/images/speaker_icon.png">
			</figure>
			<div></div>
		</fieldset>
			


	</fieldset>
	
	<script type="text/javascript">
		window.onload = function() {
  			basico_ui_init();
		};
	</script>

<?php
	include("footer.php");

/* */ // end of file