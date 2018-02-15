<?php
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


<!-- Custom scripts for this page-->
<!-- Toggle between fixed and static navbar-->
<script>
	$('#toggleNavPosition').click(function() {
		$('body').toggleClass('fixed-nav');
		$('nav').toggleClass('fixed-top static-top');
	});

</script>
<!-- Toggle between dark and light navbar-->
<script>
	$('#toggleNavColor').click(function() {
		$('nav').toggleClass('navbar-dark navbar-light');
		$('nav').toggleClass('bg-dark bg-light');
		$('body').toggleClass('bg-dark bg-light');
	});

</script>

