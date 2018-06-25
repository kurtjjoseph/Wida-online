$(function () {
	$('.datetimepicker').datetimepicker({format: 'DD/MM/YYYY'});

	$('.prev i').removeClass();
	$('.prev i').addClass("fa fa-chevron-left");

	$('.next i').removeClass();
	$('.next i').addClass("fa fa-chevron-right");


	var substringMatcher = function (strs) {
		return function findMatches(q, cb) {
			var matches, substringRegex;

			// an array that will be populated with substring matches
			matches = [];

			// regex used to determine if a string contains the substring `q`
			substrRegex = new RegExp(q, 'i');

			// iterate through the pool of strings and for any string that
			// contains the substring `q`, add it to the `matches` array
			$.each(strs, function (i, str) {
				if (substrRegex.test(str.Title) || substrRegex.test(str.Text) || substrRegex.test(str.id)) {
					matches.push(str.id+ ": " + str.Title+" - "+ str.Key);

				}
			});

			cb(matches);
		};
	};



	var songs = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
		'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
		'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
		'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
		'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
		'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
		'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
		'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
		'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
	];


	$('.songsearch').typeahead({
			hint: true,
			highlight: false,
			minLength: 1,
			classNames: {
				input: 'tt-input',
				hint: 'tt-hint',
				selectable: 'tt-selectable'
			},

		},
		{
			name: 'songlist',
			source: substringMatcher(songlist)
		}).on('typeahead:selected typeahead:autocompleted', function(e, input) {
			console.log('event');
			var inputs = input.split(":");
			var id = inputs[0];
			var title = inputs[1].split(" - ")[0];
			var key = inputs[1].split(" - ")[1];
			console.log(inputs);

			$('.songsearch').val(title );
			$('.songsearch').data( "title", title );
			$('.songsearch').data( "id", id );
			$('.songsearch').data( "originalkey", key );
			$('.songkey').val( '' ).focus();
		}).on('focus', function(e, input){
			$('.tt-input').val('');
			$('.songkey').val('');
	});


	// $.typeahead({
	// 	input: '.js-typeahead-beer_v1',
	// 	minLength: 1,
	// 	maxItem: 15,
	// 	order: "asc",
	// 	hint: true,
	// 	group: {
	// 		template: "{{group}} beers!"
	// 	},
	// 	maxItemPerGroup: 5,
	// 	backdrop: {
	// 		"background-color": "#fff"
	// 	},
	// 	href: "/beers/{{group|slugify}}/{{display|slugify}}/",
	// 	dropdownFilter: "all beers",
	// 	emptyTemplate: 'No result for "{{query}}"',
	// 	source: {
	// 		"ale": {
	// 			ajax: {
	// 				url: "/jquerytypeahead/beer_v1.json",
	// 				path: "data.beer.ale"
	// 			}
	// 		},
	// 		"lager": {
	// 			ajax: {
	// 				url: "/jquerytypeahead/beer_v1.json",
	// 				path: "data.beer.lager"
	// 			}
	// 		},
	// 		"stout and porter": {
	// 			ajax: {
	// 				url: "/jquerytypeahead/beer_v1.json",
	// 				path: "data.beer.stout"
	// 			}
	// 		},
	// 		"malt": {
	// 			ajax: {
	// 				url: "/jquerytypeahead/beer_v1.json",
	// 				path: "data.beer.malt"
	// 			}
	// 		}
	// 	},
	// 	callback: {
	// 		onClickAfter: function (node, a, item, event) {
    //
	// 			event.preventDefault;
    //
	// 			// href key gets added inside item from options.href configuration
	// 			alert(item.href);
    //
	// 		}
	// 	},
	// 	debug: true
	// });


	var $TABLE = $('#table');
	var $BTN = $('#export-btn');
	var $EXPORT = $('#export');

	$('.table-add').click(function () {


		var id = $('.songsearch').data("id");
		var title = $('.songsearch').data("title");
		var originalkey = $('.songsearch').data("originalkey");
		var key = $('.songkey').val();
		key = key === "" ? originalkey : key;

		console.log(title + " - "+ key);
		var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');



		$clone.data( "title", title );
		$clone.data( "id", id );
		$clone.data( "key", key );
		$clone.data( "originalkey", originalkey );



		$clone.find('.songtitle').text(title);
		$clone.find('.songtitle').text(title);
		$clone.find('.songkey').text(key );

		$clone.append("<input type='hidden' name='playlistsongs[id][]' value='"+id+"'>");
		$clone.append("<input type='hidden' name='playlistsongs[key][]' value='"+key+"'>");
		//$clone.find('.songkeydata').val(key );

		$TABLE.find('table').append($clone);
		$('.tt-input').val('');
		$('.songkey').val('');
		$('.songsearch').focus();

	});

	$('.table-remove').click(function () {
		$(this).parents('tr').detach();
	});

	$('.table-up').click(function () {
		var $row = $(this).parents('tr');
		if ($row.index() === 1) return; // Don't go above the header
		$row.prev().before($row.get(0));
	});

	$('.table-down').click(function () {
		var $row = $(this).parents('tr');
		$row.next().after($row.get(0));
	});

// A few jQuery helpers for exporting only
	jQuery.fn.pop = [].pop;
	jQuery.fn.shift = [].shift;

	$BTN.click(function () {
		var $rows = $TABLE.find('tr:not(:hidden)');
		var headers = [];
		var data = [];

		// Get the headers (add special header logic here)
		$($rows.shift()).find('th:not(:empty)').each(function () {
			headers.push($(this).text().toLowerCase());
		});

		// Turn all existing rows into a loopable array
		$rows.each(function () {
			var $td = $(this).find('td');
			var h = {};

			// Use the headers from earlier to name our hash keys
			headers.forEach(function (header, i) {
				h[header] = $td.eq(i).text();
			});

			data.push(h);
		});

		// Output the result
		$EXPORT.text(JSON.stringify(data));

		return false;
	});



});
