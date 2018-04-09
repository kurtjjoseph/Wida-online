function Song(input) {
	this.title = "";
	this.text = input;
	this.key = "";
	this.transposekey = "";
	this.tempo = "";
	this.time = "";
	this.textlines = [];
	this.songlines = [];
	this.songsections = [];
	this.notes = [];
	this.chords = [];
	this.guitarChords = [];
	this.pianoChords = [];
	this.chordlibrary = {};
	this.data = [];
	this.transposeInterval = 0;
}


function Cursor() {
	this.marginleft = 10;
	this.margintop = 10;
	this.currentline = 1;
	this.lineheight = 7;
	this.pageheight = 295;

}

Cursor.prototype.toppos = function () {
	return this.margintop + (this.lineheight * this.currentline);
}

Cursor.prototype.pagebreak = function (lines) {

	console.log(this.margintop + (this.lineheight * (this.currentline + 1)));
	return this.margintop + (this.lineheight * (this.currentline + lines)) >= this.pageheight;
}

Song.prototype.setChords = function () {
	var newChords = $("#chordinput").val();
	var newChordsJson = eval($("#chordinput").val());
	this.chordlibrary = newChordsJson;
}

Song.prototype.setTransposeKey = function(interval){
	this.transposeInterval = interval;
	var intervalname =  Tonal.Interval.fromSemitones(this.transposeInterval);
	this.transposekey =  Tonal.transpose(this.key,intervalname);

	if(this.transposekey === "D#"){this.transposekey = "Eb";}
	if(this.transposekey === "G#"){this.transposekey = "Ab";}


	this.transposekey
}
SongLine.prototype.transposeLine = function(){
	if(this.type === 'chord'){
		var noteRegex = "([ABCDEFG])([#b]?)";
		var songline = this;
		this.text = this.text.replace(/\|:/gi, '').replace(new RegExp(noteRegex, 'g'),function(match){
			//console.log(songline.originalkey+":"+match + " " + songline.transposeInterval + " "+ songline.transposekey + ":" +  Tonal.transpose(match, Tonal.Interval.fromSemitones(songline.transposeInterval)));

			var oldkeycenter =  songline.originalkey;
			var newkeycenter =  songline.transposekey;

			var oldkeynotes = Tonal.Scale.notes(oldkeycenter +" major");
			var newkeynotes = Tonal.Scale.notes(newkeycenter +" major");

			var currentnote = match;

			var noteInterval = Tonal.Distance.interval(oldkeycenter, currentnote);
			var transposedNote = Tonal.transpose(newkeycenter, noteInterval);



			for (var i = 0, len = newkeynotes.length; i < len; i++) {
				var normalizednote = newkeynotes[i];
				if(Tonal.Distance.interval(transposedNote, normalizednote) == 0){
					transposedNote =  normalizednote;
				}
				break;
			}

			if(transposedNote === "Fb"){transposedNote = "E";}
			if(transposedNote === "Cb"){transposedNote = "B";}
			if(transposedNote === "B#"){transposedNote = "C";}
			if(transposedNote === "E#"){transposedNote = "F";}

			console.log(Tonal.Scale.notes(oldkeycenter +" major") + "  " + currentnote + "->" + transposedNote + Tonal.Scale.notes(newkeycenter +" major"));


			return  transposedNote;
		});

	}

}




Song.prototype.toPDF = function (pdf) {
	var cursor = new Cursor();
	//console.log("song: " + this);

	pdf.setFont("helvetica");
	pdf.setFontType("bold");
	pdf.text(cursor.marginleft, cursor.toppos(), this.title + " - " + this.transposekey);
	cursor.currentline++;

	pdf.setFontSize(10);
	pdf.text(cursor.marginleft, cursor.toppos(), this.author);
	cursor.currentline++;

	pdf.setFontSize(cursor.lineheight * 2);
	for (var i = 0, len = this.songsections.length; i < len; i++) {
		var section = this.songsections[i];
		section.toPDF(pdf, cursor);
	}
}

SongSection.prototype.toPDF = function (pdf, cursor) {

	if (cursor.pagebreak(this.songlines.length)) {
		pdf.addPage();
		cursor.currentline = 1;

	}

	if (this.title !== "") {
		pdf.setFont("helvetica");
		pdf.setFontType("bold");
		pdf.text(cursor.marginleft, cursor.toppos(), this.title);
		cursor.currentline++;
	}

	for (var j = 0, lenj = this.songlines.length; j < lenj; j++) {
		var songline = this.songlines[j];
		songline.toPDF(pdf, cursor);

	}
}

SongLine.prototype.toPDF = function (pdf, cursor) {
	if (this.type === "text") {
		pdf.setFont("helvetica");
		pdf.setFontType("normal");
		pdf.text(cursor.marginleft, cursor.toppos(), this.text);
		cursor.currentline++;

	} else if (this.type === "chord") {
		pdf.setFont("helvetica");
		pdf.setFontType("bold");
		pdf.text(cursor.marginleft, cursor.toppos(), this.text);
		cursor.currentline++;
	}

	else if (this.type === "segment-title") {
		pdf.setFont("helvetica");
		pdf.setFontType("bold");
		pdf.text(cursor.marginleft, cursor.toppos(), this.text);
		cursor.currentline++;
	}
	else {
		pdf.setFontType("normal");
		pdf.text(cursor.marginleft, cursor.toppos(), '');
		cursor.currentline++;
	}
}


Song.prototype.getHtmlView = function () {
	//console.log("song: " + this);
	var html = "";
	for (var i = 0, len = this.songsections.length; i < len; i++) {
		var section = this.songsections[i];
		html += section.parseHTML();
	}
	return html;
}

SongSection.prototype.parseHTML = function () {
	var html = "<hr/>";
	if (this.title !== "") {
		html += "<span class='h3'>" + this.title + "</span>" + "\r\n";
	}

	for (var j = 0, lenj = this.songlines.length; j < lenj; j++) {
		var songline = this.songlines[j];
		html += songline.parseHTML();
	}


	return html;
}

SongLine.prototype.parseHTML = function () {
	var chordRegex = "[ABCDEFG][#b]?(minmaj|min|maj|dim|°|mi|m|M|aug|sus)?[+246/9713]*[ABCDEFG]?[#b]?";

	var html = "";
	if (this.type === "segment-title") {
		if (this.text) html += "<span class='segment-title h5'><b>" + this.text + "</b></span> \r\n";
	}
	if (this.type === "text") {
		if (this.text) html += this.text + "\r\n";
		if (this.chordText.text) html += this.chordText.parseHTML();
		if (this.lyricText.text) html += this.lyricText.text + "\r\n";
	} else if (this.type === "chord") {
		this.text = this.text.replace(/\|:/gi, '');
		var replacement = this.text.replace(/\|:/gi, '').replace(new RegExp(chordRegex, 'g'),
			"<span class='chord ' rel='tooltip' data-original-title='" + "\$&" + "'>" + "\$&" + "</span>"
		);

		html += replacement;

		// for (var i = 0, len = this.segments.length; i < len; i++) {
		// 	var segment = this.segments[i];
		// 	var trim = segment.match(/\b/);
		// 	var spaces = "";
		// 	if (trim) {
		// 		spaces = segment.substring(0, trim.index);
		// 	}
        //
        //
		// 	if (segment.trim() !== '' && segment.trim().match(chordRegex)) {
        //
		// 		var replacement = segment.replace(chordRegex,
		// 			"<span class='chord ' rel='tooltip' data-original-title='" + "\\$&" + "'>" + "\\$&" + "</span>"
		// 		);
        //
		// 		html += replacement;
		// 		//html += spaces + segment.substring(0, trim) + "<span class='chord ' rel='tooltip' data-original-title='" + segment + "'>" + segment.trim() + "</span>";
		// 	} else {
		// 		html += " ";
		// 	}
		// }




		html += "\r\n";
	}
	else {
		html += "\r\n";
	}
	return html;
}

Song.prototype.parseChords = function () {
	for (var i = 0, len = this.songlines.length; i < len; i++) {
		var currLine = this.songlines[i];

		if (currLine.type === 'chord') {

			var linechords = currLine.text.split(/\s/gi);

			this.chords = [];

			for (var j = 0, clen = linechords.length; j < clen; j++) {

				if (linechords[j].trim().length != 0) {

					var chord = new Chord(linechords[j].trim());
					chord.parseChord();
					this.chords.push(chord);

					if (this.chordlibrary[chord.name] == null) {
						this.chordlibrary[chord.name] = [];
					}
					if (!this.chordlibrary[chord.name].includes(chord)) {
						this.chordlibrary[chord.name].push(chord);
					}
					if (this.chordlibrary[chord.name].length != 0) {
						chord = this.chordlibrary[chord.name][0];
					}
				}
			}
		}
	}

}

Song.prototype.formatChordLibrary = function (chordlibrary) {

	this.chordlibrary = chordlibrary;

	var html = "[{";
	var i = 0;
	for (var property in chordlibrary) {
		if (chordlibrary.hasOwnProperty(property)) {


			var bucket = chordlibrary[property];
			if (i != 0) {
				html += ","
			}
			;
			html +=
				"\"" + property + "\":[" + "\r\n";
			for (var j = 0; j < bucket.length; j++) {
				var chord = bucket[j];


				if (j != 0) {
					html += ",";
				}
				;
				html +=
					"     {" + "\r\n" +
					"       \"text\":\"" + chord.text + "\"," +
					"\"name\":\"" + chord.name + "\"," +
					"\"quality\":\"" + chord.quality + "\"," +
					"\"quantity\":\"" + chord.quantity + "\"," +
					"\"key\":\"" + chord.key + "\"," +
					"\"root\":\"" + chord.root + "\"," +
					"\"position\":\"" + chord.position + "\"," +
					"\"notes\":" + JSON.stringify(chord.notes) + "," +
					"\r\n" +

					"       \"guitarChord\":{" +
					"\"name\":\"" + chord.guitarChord.name + "\"," +
					"\"chord\":" + JSON.stringify(chord.guitarChord.chord) + "," +
					"\"position\":" + chord.guitarChord.position + "," +
					"\"bars\":\"" + chord.guitarChord.bars + "\"" +
					"},\r\n" +

					"       \"pianoChord\":{" +
					"\"name\":\"" + chord.pianoChord.name + "\"," +
					"\"chord\":" + JSON.stringify(chord.pianoChord.chord) + "," +
					"\"position\":" + chord.pianoChord.position + "," +
					"\"bars\":\"" + chord.pianoChord.bars + "\"" +
					"}\r\n" +
					"    }" + "\r\n";


				i++;
			}
			html += "]";
		}

	}
	html += "}]" + "\r\n";

	//console.log(this.chordlibrary);
	return html;
}

Song.prototype.parseSonglines = function () {

	//Get lines
	Array.prototype.push.apply(this.textlines, this.text.split(/[\r\n]/));

	//console.log(this.textlines);
	var prevLine = "";
	var history = [];

	var songSection = new SongSection();

	var parseBuffer = 0;
	for (var i = 0, len = this.textlines.length; i < len; i++) {
		parseBuffer++;
		var currentsongline = new SongLine(this.textlines[i]);

		currentsongline.transposeInterval = this.transposeInterval;
		currentsongline.originalkey = this.key;
		currentsongline.transposekey = this.transposekey;

		currentsongline.parseText();
		songSection.songlines.push(currentsongline);
		if (currentsongline.type === "empty") {
			this.songsections.push(songSection);
			songSection = new SongSection();
		}
	}

	//console.log("History: " + history);
	//console.log(this.songsections);


	if (songSection.songlines.length !== 0) {
		this.songsections.push(songSection);
	}
}

function SongSection() {
	this.type = "text";
	this.title = "";
	this.songlines = [];
	this.notes = [];
	this.chords = [];
}


function SongLine(input) {

	this.chordText = "";
	this.lyricText = "";

	this.text = input;
	this.type = "text";
	this.segments = [];
	this.notes = [];
	this.chords = [];
	this.emptyline = false;

	this.transposeInterval = 0;
	this.originalkey = "";
	this.transposekey = "";
}


SongLine.prototype.parseText = function () {
	this.segments = this.text.replace(/\t/, "        ").split(/\s/gi);
	//console.log(this.segments);
	this.setType();

	this.transposeLine();

}

SongLine.prototype.setType = function () {
	if (this.isEmptyLine(this.text)) this.type = "empty";
	else if (this.isChordLine(this.text)) this.type = "chord";
	else if (this.isSegmentTitleLine(this.text)) this.type = "segment-title";
	else this.type = "text";
	//console.log(this.type + ": " + this.text);
}

SongLine.prototype.parseChords = function (input) {
	var chordRegex = "[ABCDEFG][#b]?(minmaj|min|maj|dim|°|mi|m|M|aug|sus)?[+246/9713]*[ABCDEFG]?[#b]?";

	var chords = input.trim().match(chordRegex);
	//console.log(chords);
	return chords;
}

SongLine.prototype.isEmptyLine = function (input) {
	return input.trim().length === 0;
}

SongLine.prototype.isTextLine = function (input) {
	if (input == null) return false;
	var matches = input.match(/:/);
	if (matches == null) return false;
	return matches;
}

SongLine.prototype.isSegmentTitleLine = function (input) {
	if (input == null) return false;
	var matches = input.match(/[:\[\]]/);
	var regex = /\s+/gi;
	var wordCount = input.trim().replace(regex, ' ').split(' ').length;
	if (matches == null && wordCount >= 2) return false;
	return true;
}

SongLine.prototype.isChordLine = function (input) {
	var beginlength = input.length;
	var str = input.replace(/ /gi, '');
	var trimlength = str.length;

	var lineIsSpaced = trimlength < (beginlength / 2);

	var chordRegex = "[ABCDEFG][#b]?(minmaj|min|maj|dim|°|mi|m|M|aug|sus)?[+246/9713]*[ABCDEFG]?[#b]?";

	if (lineIsSpaced) return true;

	if(input.match(/\|:/))return true;
	if(input.trim().match(/^\|.+\|$/))return true;

	var hasChordsOnly = true;

	for (var i = 0, len = this.segments.length; i < len; i++) {

		if (this.segments[i].trim() !== '' && !this.segments[i].trim().match(chordRegex)) {
			hasChordsOnly = false;
			break;
		}
	}

	return lineIsSpaced || hasChordsOnly;

}

SongLine.prototype.parseType = function (input) {

}

function Chord(input) {
	this.text = input;
	this.name = input;
	this.quality = "";
	this.quantity = "";
	this.key = "";
	this.root = "";
	this.position = "";
	this.guitarChord =
		{
			name: input,
			chord: [[1, 0], [2, 0], [3, 0], [4, 0], [5, 0], [6, 0]],
			position: 0,
			bars: []
		};
	this.pianoChord =
		{
			name: input,
			chord: [[1, 0], [2, 0], [3, 0], [4, 0], [5, 0], [6, 0]],
			position: 0,
			bars: []
		};
	this.notes = [];
}

Chord.prototype.parseChord = function () {

}
