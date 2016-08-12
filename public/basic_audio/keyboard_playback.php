<?php
	$page_title = "Basic Oscillator/Gain Demo";
	include("header.php");
?>
	<div class="tglbtn" data-affect-id="pianokeys" data-active-class="full"><button>Toggle Full Keyboard</button><div class="indicator"></div></div>

	<div class="tglbtn" data-cb-method="record_keys" data-cb-target="piano"><button>Record</button><div class="indicator record"></div></div>

	<div class="tglbtn" data-cb-method="transpose" data-cb-target="piano"><label class="btnlbl">Transpose <button class="rounded" data-transpose="up">+</button><button class="rounded" data-transpose="down">-</button></label></div>

	<div id="pianokeys" class="clearfix">

		<div class="keyrow meta">
			<div class="key ghost meta" data-keyname="escape" data-keyboard="esc"></div>
			<div class="key ghost meta" data-keyboard="F1"></div>
			<div class="key ghost meta" data-keyboard="F2"></div>
			<div class="key ghost meta" data-keyboard="F3"></div>
			<div class="key ghost meta" data-keyboard="F4"></div>
			<div class="key ghost meta" data-keyboard="F5"></div>
			<div class="key ghost meta" data-keyboard="F6"></div>
			<div class="key ghost meta" data-keyboard="F7"></div>
			<div class="key ghost meta" data-keyboard="F8"></div>
			<div class="key ghost meta" data-keyboard="F9"></div>
			<div class="key ghost meta" data-keyboard="F10"></div>
			<div class="key ghost meta" data-keyboard="F11"></div>
			<div class="key ghost meta" data-keyboard="F12"></div>
			<div class="key ghost meta" data-keyname="power" data-keyboard="pwr"></div>
		</div>
		<div class="keyrow top">
			<div class="key ghost meta" data-keyname="backtick" data-keyboard="~`"></div>
			<div class="key ghost meta" data-keyboard="1"></div>
			<div class="key ghost meta" data-keyboard="2"></div>
			<div class="key ghost meta" data-keyboard="3"></div>
			<div class="key ghost meta" data-keyboard="4"></div>
			<div class="key ghost meta" data-keyboard="5"></div>
			<div class="key ghost meta" data-keyboard="6"></div>
			<div class="key ghost meta" data-keyboard="7"></div>
			<div class="key ghost meta" data-keyboard="8"></div>
			<div class="key ghost meta" data-keyboard="9"></div>
			<div class="key ghost meta" data-keyboard="0"></div>
			<div class="key ghost meta" data-keyname="hyphen" data-keyboard="_-"></div>
			<div class="key ghost meta" data-keyname="equals" data-keyboard="+="></div>
			<div class="key ghost meta" data-keyname="delete" data-keyboard="&#9003;"></div>
		</div>

		<div class="keyrow piano">
			<div class="key ghost meta" data-keyname="tab" data-keyboard="&#8677;"></div>
			<div class="key ghost meta" data-keyname="capslock" data-keyboard="&#8682;"></div>

			<div class="key ghost" data-keyboard="Q"></div>

			<div class="key" data-note="C-4" data-keyboard="A" data-marker="start"></div>
			<div class="key" data-note="C#4" data-keyboard="W"></div>
			<div class="key" data-note="D-4" data-keyboard="S"></div>
			<div class="key" data-note="D#4" data-keyboard="E"></div>
			<div class="key" data-note="E-4" data-keyboard="D"></div>

			<div class="key ghost" data-keyboard="R"></div>

			<div class="key" data-note="F-4" data-keyboard="F"></div>
			<div class="key" data-note="F#4" data-keyboard="T"></div>
			<div class="key" data-note="G-4" data-keyboard="G"></div>
			<div class="key" data-note="G#4" data-keyboard="Y"></div>
			<div class="key" data-note="A-4" data-keyboard="H"></div>
			<div class="key" data-note="A#4" data-keyboard="U"></div>
			<div class="key" data-note="B-4" data-keyboard="J"></div>

			<div class="key ghost" data-keyboard="I"></div>

			<div class="key" data-note="C-5" data-keyboard="K"></div>
			<div class="key" data-note="C#5" data-keyboard="O"></div>
			<div class="key" data-note="D-5" data-keyboard="L"></div>
			<div class="key" data-note="D#5" data-keyboard="P"></div>
			<div class="key" data-note="E-5" data-keyname="colon" data-keyboard=":;"></div>
			<div class="key" data-note="F-5" data-keyname="quote" data-keyboard="&quot;'" data-marker="end"></div>

			<div class="key ghost meta" data-keyname="lbrace" data-keyboard="{["></div>

			<div class="key ghost meta" data-keyname="quote" data-keyboard="&quot;'"></div>

			<div class="key ghost meta" data-keyname="rbrace" data-keyboard="}]"></div>

			<div class="key ghost meta" data-keyname="enter" data-keyboard="&#8629;"></div>

			<div class="key ghost meta" data-keyname="bkslash" data-keyboard="|\"></div>

		</div><!-- end .keyrow.piano -->

		<div class="keyrow bottom">
			<div class="key ghost meta" data-keyname="lshift" data-keyboard="&#8679;"></div>
			<div class="key ghost meta" data-keyboard="Z"></div>
			<div class="key ghost meta" data-keyboard="X"></div>
			<div class="key ghost meta" data-keyboard="C"></div>
			<div class="key ghost meta" data-keyboard="V"></div>
			<div class="key ghost meta" data-keyboard="B"></div>
			<div class="key ghost meta" data-keyboard="N"></div>
			<div class="key ghost meta" data-keyboard="M"></div>
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
			<div class="key ghost meta" data-keyname="space" data-keyboard="space"></div>
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

		<fieldset class="default">
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