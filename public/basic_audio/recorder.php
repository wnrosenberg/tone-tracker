<?php
	$page_title = "Basic Audio Recording with Recorder.js";
	include("header.php");
?>
	<p>Basic Audio Recording with Recorder.js and the Keyboard Layout</p>


	<div id="pianokeys" class="recording clearfix">

		<div class="keyrow bottom">
			<div class="key meta" data-keyname="lshift" data-keyboard="&#8679;"></div>
			<div class="key meta" data-keyboard="Z"></div>
			<div class="key meta" data-keyboard="X"></div>
			<div class="key meta" data-keyboard="C"></div>
			<div class="key meta" data-keyboard="V"></div>
			<div class="key meta" data-keyboard="B"></div>
			<div class="key meta" data-keyboard="N"></div>
			<div class="key meta" data-keyboard="M"></div>
			<div class="key ghost meta" data-keyname="comma" data-keyboard="&lt;,"></div>
			<div class="key ghost meta" data-keyname="period" data-keyboard="&gt;."></div>
			<div class="key ghost meta" data-keyname="slash" data-keyboard="?/"></div>
			<div class="key ghost meta" data-keyname="rshift" data-keyboard="&#8679;"></div>
		</div>

		<div class="keyrow bottom">
			<div class="key ghost meta" data-keyname="fn" data-keyboard="&#8679;"></div>
			<div class="key ghost meta" data-keyname="lctrl" data-keyboard="ctrl"></div>
			<div class="key ghost meta" data-keyname="lalt" data-keyboard="&#8997;"></div>
			<div class="key ghost meta" data-keyname="lcmd" data-keyboard="&#8984;"></div>
			<div class="key meta" data-keyname="space" data-keyboard="space"></div>
			<div class="key ghost meta" data-keyname="rcmd" data-keyboard="&#8984;"></div>
			<div class="key ghost meta" data-keyname="ralt" data-keyboard="&#8997;"></div>
			<div class="arrows">
				<div class="key ghost arrow" data-keyname="up_arrow" data-keyboard="&uarr;"></div>
				<div class="key ghost arrow" data-keyname="left_arrow" data-keyboard="&larr;"></div>
				<div class="key ghost arrow" data-keyname="down_arrow" data-keyboard="&darr;"></div>
				<div class="key ghost arrow" data-keyname="right_arrow" data-keyboard="&rarr;"></div>
			</div>
		</div>

	</div><!-- end #pianokeys -->

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