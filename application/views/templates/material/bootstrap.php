<!doctype html>
<html lang="en">
<head>
	<?php echo $html_header ?>
</head>
<body>
<div class="wrapper">
	<div class="sidebar" data-color="purple" data-image="<?=$scriptdir?>assets/img/sidebar-1.jpg">
		<?php echo $logo ?>
		<div class="sidebar-wrapper">
			<?php echo $navbar['top'] ?>
		</div>
	</div>
	<div class="main-panel">
		<?php echo $navbar['main'] ?>
		<div class="content">
			<?php echo $content ?>
		</div>
		<!--footer class="footer">
			<div class="container-fluid">
				<?php echo $html_footer ?>
			</div>
		</footer-->
	</div>
</div>
</body>
<?php echo $templatescripts ?>
<?php echo $pagescripts ?>
</html>
