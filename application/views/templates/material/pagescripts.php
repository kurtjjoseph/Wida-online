<?php
foreach ($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>"/>
<?php endforeach; ?>


<style>
	.boxsizingBorder {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}

	.mat-input-element {
		font: inherit;
		background: 0 0;
		color: currentColor;
		border: none;
		outline: 0;
		padding: 0;
		margin: 0;
		width: 100%;
		max-width: 100%;
		vertical-align: bottom;
		text-align: inherit
	}

	.mat-input-element:-moz-ui-invalid {
		box-shadow: none
	}

	.mat-input-element::-ms-clear, .mat-input-element::-ms-reveal {
		display: none
	}

	.mat-input-element[type=date]::after, .mat-input-element[type=datetime-local]::after, .mat-input-element[type=datetime]::after, .mat-input-element[type=month]::after, .mat-input-element[type=time]::after, .mat-input-element[type=week]::after {
		content: ' ';
		white-space: pre;
		width: 1px
	}

	.mat-input-element::placeholder {
		transition: color .4s .133s cubic-bezier(.25, .8, .25, 1)
	}

	.mat-input-element::-moz-placeholder {
		transition: color .4s .133s cubic-bezier(.25, .8, .25, 1)
	}

	.mat-input-element::-webkit-input-placeholder {
		transition: color .4s .133s cubic-bezier(.25, .8, .25, 1)
	}

	.mat-input-element:-ms-input-placeholder {
		transition: color .4s .133s cubic-bezier(.25, .8, .25, 1)
	}

	.mat-form-field-hide-placeholder .mat-input-element::placeholder {
		color: transparent !important;
		transition: none
	}

	.mat-form-field-hide-placeholder .mat-input-element::-moz-placeholder {
		color: transparent !important;
		transition: none
	}

	.mat-form-field-hide-placeholder .mat-input-element::-webkit-input-placeholder {
		color: transparent !important;
		transition: none
	}

	.mat-form-field-hide-placeholder .mat-input-element:-ms-input-placeholder {
		color: transparent !important;
		transition: none
	}

	textarea.mat-input-element {
		resize: vertical;
		overflow: auto
	}

	textarea.mat-autosize {
		resize: none
	}

	.section .title {
		font-weight: bold;
		text-decoration: underline;
	}

	.section .chord {
		font-weight: bold;
	}

	.preformatted {
		font-family: monospace;
		white-space: pre;
	}

	.fa-b {
		background: url("http://localhost/wida-online/assets/common/img/b.svg");
		width: 20px;
		height: 20px;
		display: block;
		padding-left: 20px;
	}

	.btn-purple {
		color: #fff;
		border-color: #fff;
		background: linear-gradient(60deg, #ab47bc, #b831de);
	}

	.chord {
		color: orangered;
		font-weight: bold;
	}

	html {
		overflow: hidden;
	}

</style>


<script type="text/javascript">
	function filter() {
		var songs = document.getElementById("songs");
		songs.classList.remove("table-striped");


		// Declare variables
		var input, filter, key, keyfilter, table, tr, td, tdkey, i;
		input = document.getElementById("myInput");
		key = document.getElementById("key");

		filter = input.value.toUpperCase();
		keyfilter = key.value.toUpperCase();

		table = document.getElementById("songs");
		tr = table.getElementsByTagName("tr");

		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {

			tr[i].classList.remove("stripe");

			td = tr[i].getElementsByTagName("td")[0];
			hide = false;
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					hide = false;
				} else {
					hide = true;
				}
			}

			tdkey = tr[i].getElementsByTagName("td")[1];
			if (tdkey && keyfilter && !hide) {
				if (tdkey.innerHTML.toUpperCase() == keyfilter) {
					hide = false;
				} else {
					hide = true;
				}
			}


			if (hide) {
				tr[i].style.display = "none";
			}
			else {
				tr[i].style.display = "";
				if (i % 2 == 0) {
					tr[i].classList.add("stripe");
				}
			}

		}
	}

	// Edit song form logic
	$("#youtubelink").change(setVideoPreview);
	$("#songtext").on('input', setPreview);
	$("#chordinput").on('input', setPreview);
	$("#fillchords").click(fillChords);
	$("#updatechords").click(setPreview);

	$("#trans-up").click(transposeUp);
	$("#trans-down").click(transposeDown);
	$("#pdfdownload").click(savePDF);

	$("#songtext").val($("#songtext").val().replace(/\t/, "        "));
	setVideoPreview();
	setPreview();

	function transposeUp() {
		$("#transposekey").val((eval($("#transposekey").val()) + 1) % 12);
		setPreview();
	}

	function transposeDown() {
		$("#transposekey").val((eval($("#transposekey").val()) - 1) % 12);
		setPreview();
	}

	function savePDF() {
		var parsedSong = parseSong($("#songtext").val());
		parsedSong.title = $("#Title").val();
		parsedSong.key = $("#Key").val();
		parsedSong.author = $("#Author").val();

		savePdfView(parsedSong);
	}

	function setPreview() {
		var parsedSong = parseSong($("#songtext").val());
		parsedSong.title = $("#Title").val();
		parsedSong.key = $("#Key").val();
		parsedSong.author = $("#Author").val();

		$("#textpreview").html(parsedSong.getHtmlView());
		setChordInput(parsedSong);
		pdfView(parsedSong);
	}

	function setVideoPreview() {

		//
		// <iframe width="560" height="315" src="http://www.youtube.com/embed/0vrdgDdPApQ?playlist=cbut2K6zvJY,7iw30sK2UCo,sYV5MTy0v1I" frameborder="0" allowfullscreen></iframe>
		// 	'drumcover' => $this->input->post('drumcover'),
		// 		'basscover' => $this->input->post('basscover'),
		// 		'zangcover' => $this->input->post('zangcover'),
		// 		'pianocover' => $this->input->post('pianocover'),
		// 		'elguitarcover' => $this->input->post('elguitarcover'),
		// 		'acguitarcover'

		var youtubeid = parseLink($("#youtubelink").val());
		var drumcover = parseLink($("#drumcover").val());
		var basscover = parseLink($("#basscover").val());
		var zangcover = parseLink($("#zangcover").val());
		var pianocover = parseLink($("#pianocover").val());
		var elguitarcover = parseLink($("#elguitarcover").val());
		var acguitarcover = parseLink($("#acguitarcover").val());

		var playlist = [drumcover, basscover, zangcover, pianocover, elguitarcover, acguitarcover];
		playlist = playlist.filter(function (e) {
			return e
		}).join(",");
		if (playlist !== "") {
			playlist = "?playlist=" + playlist
		}
		$(".youtube-preview").html(
			"<iframe id=\"songVideo\" width=\"100%\" height=\"347\" src=\"//www.youtube.com/embed/"
			+ youtubeid +
			playlist +
			"\" frameborder=\"0\" allowfullscreen></iframe>"
		);

	}

	function fillChords() {
		var song = parseSong($("#songtext").val());
		var html = "[" + JSON.stringify(song.chordlibrary) + "]";
		$("#chordinput").html(html);
		setChordInput(song)
	}

	function setChordInput(song) {
		var html = "";

		var newChords = $("#chordinput").val();

		try {
			var newChordsJson = eval($("#chordinput").val());

			$("#chordinput").val(song.formatChordLibrary(newChordsJson[0]));

			showChords(song, song.chordlibrary);
		} catch (e) {
			if (e instanceof SyntaxError) {
				//alert(e.message);
			}
		}

	}

	function parseLink(input) {
		var parts = input.split("/");
		//console.log(parts);
		return parts[parts.length - 1];
	}

	function showChords(song, chordlibrary) {
		var container = $("#chords");

		//$("#chords").html("test");


		for (var property in chordlibrary) {
			if (chordlibrary.hasOwnProperty(property)) {
				var bucket = chordlibrary[property];


				var chord_chart = {
					section: property,
					description: "",
					chords: bucket
				};
				var section_struct = chord_chart;
				var section = createSectionElement(section_struct);
				for (var j = 0; j < bucket.length; ++j) {
					section.append(createChordElement(section_struct.chords[j].guitarChord));
				}
				container.append(section);
			}
		}


		// // Display preset chords (open chords)
		// for (var i = 0; i < chord_chart.length; ++i) {
		// 	var section_struct = chord_chart[i];
		// 	var section = createSectionElement(section_struct);
		//
		// 	for (var j = 0; j < section_struct.chords.length; ++j) {
		// 		section.append(createChordElement(section_struct.chords[j]));
		// 	}
		//
		// 	container.append(section);
		// }
		//
		// // Display shape chords for all keys
		// var keys_E = ["F", "F#", "Gb", "G", "G#", "Ab", "A", "A#", "Bb", "C"];
		// var keys_A = ["C#", "Db", "D", "D#", "Eb", "F", "F#", "Gb", "G"];
		//
		// var shapes_E = [
		// 	"M E", "m E", "7 E", "m7 E", "M7 E", "m7b5 E", "dim E",
		// 	"sus4 E", "7sus4 E", "13 E"];
		// var shapes_A = [
		// 	"M A", "m A", "7 A", "m7 A", "M7 A", "m7b5 A", "dim A",
		// 	"sus2 A", "sus4 A", "7sus4 A", "9 A", "7b9 A", "7#9 A", "13 A"];
		//
		// createShapeChart(keys_E, container, shapes_E, "E");
		// createShapeChart(keys_A, container, shapes_A, "A");

	}

	function parseSong(input) {

		var song = new Song(input);
		song.key = $("#Key").val();

		song.setTransposeKey($("#transposekey").val());

		$("#selectedKey").html(song.transposekey);

		song.parseSonglines();

		if ($("#chordinput").html() === '') {
			song.setChords();
		} else {

			song.parseChords();
		}
		//console.log(song);


		// song.text = input;
		// song.parseText()
		// song.lines.push("test line");
		// Array.prototype.push.apply(song.lines,input.split(/[\r\n]/) );
		//
		// console.log(song);
		//
		// for (var i = 0, len = song.lines.length; i < len; i++) {
		// 	var currentline = song.lines[i];
		// 	var output = [];
		// 	output['line'] = currentline;
		// 	output['empty_line'] = isEmptyLine(currentline);
		// 	output['text_line'] = isTextLine(currentline);
		// 	output['title_line'] = isTitleLine(currentline);
		// 	output['chord_line'] = isChordLine(currentline);
		//
		// 	console.log(output);
		// }
		//
		// var chordChars = "ABCDEFGIJMNabcdefghijklmnopqrstuvwxyz1234567890";
		// var chordNames ="m,M,Maj,min,maj";

		return song;
	}

	function pdfView(song) {
		var pdf = new jsPDF();

		song.toPDF(pdf);

		// pdf.setFont("helvetica");
		// pdf.setFontType("bold");
		// pdf.text(20, 50, 'This i');

		if (typeof pdf !== 'undefined') try {
			if (navigator.msSaveBlob) {
				// var string = pdf.output('datauristring');
				string = 'http://microsoft.com/thisdoesnotexists';
				console.error('Sorry, we cannot show live PDFs in MSIE')
			}else {
				var string = pdf.output('bloburi');
				$('.preview-pane').attr('src', string + '#zoom=50');
			}
		} catch (e) {
			alert('Error ' + e);
		}

	}

	function savePdfView(song) {
		var pdf = new jsPDF();
		song.toPDF(pdf);
		if (typeof pdf !== 'undefined') try {
			pdf.save(song.title +" - " + song.transposekey+  '.pdf');
		} catch (e) {
			alert('Error ' + e);
		}
	}

	function renderChords() {

		var draw = SVG('drawing').size(300, 300);
		var rect = draw.rect(100, 100).attr({fill: '#f06'});
		rect.mousedown(function () {
			this.fill({color: '#006'})
		});
		rect.mouseup(function () {
			this.fill({color: '#f06'})
		});
		rect.mouseover(function () {
			this.fill({color: '#026'})
		});
		rect.mouseout(function () {
			this.fill({color: '#f06'})
		});
	}

</script>
test
<?php foreach ($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
