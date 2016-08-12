<?php
	$page_title = "Basic Audio Recording with Recorder.js";
	include("header.php");
?>
	<p>Basic Audio Recording with Recorder.js</p>

	<fieldset id="recorder_controls">
		<legend>Recorder Controls</legend>

		<div class="buttons">
			<button id="record"><span>&#9679;</span></button>
		</div>


	</fieldset>


	<fieldset id="controls">
		<legend>Controls</legend>

		<fieldset>
			<legend>Master Volume</legend>
			<figure class="icon">
				<img src="./assets/images/speaker_icon.png">
			</figure>
			<div>
				<label><span>Volume:</span> <input id="gvol" type="range" value="0.75" min="0.00" max="1.00" step="0.05" /></label><input type="text" class="range_value" data-round=".01" value="0.75" />
			</div>
		</fieldset>
		
	</fieldset>
	
<?php
	include("footer.php");

/* */ // end of file