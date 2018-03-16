function Song(input) {
	this.title = "";
	this.text = input;
	this.key = "";
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
}


Song.prototype.setChords = function () {
	var newChords = $("#chordinput").html();
	var newChordsJson = eval($("#chordinput").html());
	this.chordlibrary = newChordsJson;
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

					if(this.chordlibrary[chord.name]  == null){
						this.chordlibrary[chord.name] = [];
					}
					if(!this.chordlibrary[chord.name].includes(chord)){
						this.chordlibrary[chord.name].push(chord);
					}
					if(this.chordlibrary[chord.name].length != 0) {
						chord = this.chordlibrary[chord.name][0];
					}
				}
			}
		}
	}

}





Song.prototype.formatChordLibrary = function(chordlibrary){

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

	console.log(this.chordlibrary);
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
		currentsongline.parseText();
		this.songlines.push(currentsongline);
		history.push(currentsongline.type);


		if (i == 2) {
			if (history[i - 2] === "text") {
				if (history[i - 1] === "empty") {
					history[i - 2] = "title";
					this.songlines[i - 2].type = "title";
					this.title = this.songlines[i - 2].text;
				}
			}
		}

		if (parseBuffer == 1) {
			if (currentsongline.type === "segment-title") {
				if (history[i - 1] === "text") {
					var songline = new SongLine();
					songline.lyricText = this.songlines[i - 1];
					songSection.songlines.push(songline);
				}
				if (history[i - 1] === "chord") {
					var songline = new SongLine();
					songline.chordText = this.songlines[i - 1];
					songSection.songlines.push(songline);
				}
				if (history[i - 1] === "segment-title") {
					this.songsections.push(songSection);
					songSection = new SongSection();
				}


				songSection.title = currentsongline.text;
				parseBuffer = 0;
			}

			if (currentsongline.type === "empty") {
				var songline = new SongLine();
				songline.emptyline = true;
				songline.lyricText = currentsongline.text;
				songSection.songlines.push(songline);
				this.songsections.push(songSection);
				songSection = new SongSection();
				parseBuffer = 0;
			}
		}

		if (parseBuffer == 2) {
			if (history[i - 1] === "chord") {
				//Chord - Lyric
				if (history[i] === "text") {
					var songline = new SongLine();
					songline.chordText = this.songlines[i - 1];
					songline.lyricText = this.songlines[i];
					songSection.songlines.push(songline);

					parseBuffer = 0;
				}
				// Chord - Chord
				if (history[i] === "chord") {
					var songline = new SongLine();
					songline.chordText = this.songlines[i - 1];
					songSection.songlines.push(songline);

					parseBuffer = 1;
				}

				// Chord - Empty
				if (history[i] === "empty") {
					var songline = new SongLine();
					songline.chordText = this.songlines[i - 1];
					songline.lyricText = this.songlines[i];
					songSection.songlines.push(songline);

					this.songsections.push(songSection);
					songSection = new SongSection();

					parseBuffer = 0;
				}
			}


			if (history[i - 1] === "text") {

				//Lyric - Lyric
				if (history[i] === "text") {
					var songline = new SongLine();
					songline.lyricText = this.songlines[i - 1];
					songSection.songlines.push(songline);

					songline = new SongLine();
					songline.lyricText = this.songlines[i];
					songSection.songlines.push(songline);
					parseBuffer = 0;
				}
				// Lyric - Chord
				if (history[i] === "chord") {
					var songline = new SongLine();
					songline.chordText = this.songlines[i - 1];
					songSection.songlines.push(songline);

					parseBuffer = 1;
				}

				// Lyric - Empty
				if (history[i] === "empty") {
					var songline = new SongLine();
					songline.chordText = this.songlines[i - 1];
					songline.lyricText = this.songlines[i];
					songSection.songlines.push(songline);

					parseBuffer = 0;
				}


			}

			if (history[i - 1] === "segment-title") {

				// Segment-title - Chord
				if (history[i] === "chord") {
					var songline = new SongLine();
					songline.chordText = this.songlines[i - 1];
					songSection.songlines.push(songline);

					parseBuffer = 0;
				}
				// Segment-title - Chord
				if (history[i] === "text") {
					var songline = new SongLine();
					songline.lyricText = this.songlines[i - 1];
					songSection.songlines.push(songline);

					parseBuffer = 0;
				}
				// Segment-title - Empty
				if (history[i] === "empty") {
					var songline = new SongLine();
					songline.emptyline = true;
					songSection.songlines.push(songline);

					parseBuffer = 0;
				}
			}


		}

	}
	if (parseBuffer == 0) {
		this.songsections.push(songSection);
	}
	if (parseBuffer == 1) {
		if (history[i] === "text") {
			var songline = new SongLine();
			songline.lyricText = this.songlines[i];
			songSection.songlines.push(songline);
		}
		if (history[i] === "chord") {
			var songline = new SongLine();
			songline.chordText = this.songlines[i];
			songSection.songlines.push(songline);
		}

		if (history[i] === "segment-title") {
			this.songsections.push(songSection);
			songSection = new SongSection();
			songSection.title = songline.text;
			var songline = new SongLine();
			songline.chordText = this.songlines[i - 1];
			songSection.songlines.push(songline);
		}

		this.songsections.push(songSection);
	}



	//console.log("History: " + history);
	//console.log(this.songsections);

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
}

SongLine.prototype.parseText = function () {
	this.segments = this.text.split(/ /gi);
	//console.log(this.segments);
	this.setType();
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

Chord.prototype.parseChord = function(){

}
