<?php
foreach ($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>"/>
<?php endforeach; ?>
<?php foreach ($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
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
	$("#youtubelink").change(setPreview);
	$("#songtext").on('input',setPreview);
	$("#chordinput").on('input',setPreview);
	$("#fillchords").on('input',fillChords);
	$("#updatechords").click(setPreview);

	setPreview();

	function setPreview() {
		var youtubeid = parseLink($("#youtubelink").val());
		$(".youtube-preview").html(
			"<iframe id=\"songVideo\" width=\"100%\" height=\"347\" src=\"//www.youtube.com/embed/"
			+ youtubeid +
			"\" frameborder=\"0\" allowfullscreen></iframe>"
		);

		var parsedSong = parseSong($("#songtext").val());

		setChordInput(parsedSong);


		var string = pdfView(parsedSong);
		$('.preview-pane').attr('src', string);
		$("#textpreview").html(parsedSong);

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

		var newChordsJson = eval($("#chordinput").val());

		$("#chordinput").html(song.formatChordLibrary(newChordsJson[0]));

		showChords(song, song.chordlibrary);
	}

	function parseLink(input) {
		var parts = input.split("/");
		//console.log(parts);
		return parts[parts.length - 1];
	}


	function showChords(song, chordlibrary) {
		var container = $("#chords");

		$("#chords").html("");


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


	function isEmptyLine(input) {
		return input.trim().length == 0;
	}

	function isTextLine(input) {
		if (input == null) return false;
		var matches = input.match(/:/);
		if (matches == null) return false;
		return matches;
	}

	function isTitleLine(input) {
		if (input == null) return false;
		var matches = input.match(/:/);
		if (matches == null) return false;
		return matches;
	}

	function isChordLine(input) {
		var chordsRegex = /\\b[A-G][#b]?(minmaj|min|maj|dim|°|mi|m|M|aug|sus)?[+246/9713]*[A-G]?[#b]?\\b/;
		var noteRegex = /[A-G][#b]?/;

		if (input == null) return false;
		var matches = input.match(chordsRegex);
		if (matches == null) return false;
		return matches;
	}


	function pdfView(input) {
		var doc = new jsPDF();

		// We'll make our own renderer to skip this editor
		var specialElementHandlers = {
			'#editor': function (element, renderer) {
				return true;
			},
			'.controls': function (element, renderer) {
				return true;
			}
		};

		// All units are in the set measurement for the document
		// This can be changed to "pt" (points), "mm" (Default), "cm", "in"
		doc.fromHTML(input.text, 15, 15, {
			'width': 170,
			'elementHandlers': specialElementHandlers
		});
		return doc.output('bloburi');
	}


</script>
