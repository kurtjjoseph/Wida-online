<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
</head>
<body>
<?php echo $html_head ?>
<?php echo $navbar ?>

<div>
	<a href='<?php echo site_url('examples/songs_management')?>'>Songs</a>
	<h1>Latest songs</h1>
	<?php echo $latestsongs ?>
	<h1>Selected song</h1>
	<?php echo $selectedsong ?>
</div>
<?php echo $html_footer ?>
</body>
</html>

