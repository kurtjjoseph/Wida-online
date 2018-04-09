<style>
	#songs tr{
		cursor: pointer;
	}
</style>
<div class="row">
<div class="col-sm-6"><input class="form-control label-floating" type="text" id="myInput" onkeyup="filter()" placeholder="Zoek een lied ... " /></div>
<div class="col-sm-6"><input class="form-control label-floating" type="text" id="key" onkeyup="filter()" placeholder="Key"/></div>
</div>
<table id="songs" class="songs table table-sm table-hover table-striped">
	<thead>
	<tr>
		<th scope="col">Title</th>
		<th scope="col">Key</th>
		<th scope="col">Acties</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($songs as $id => $song) { ?>
		<tr onclick="location.href='songs/song/<?= $song->id; ?>';">
			<td>
				<span class="title"><?= $song->Title; ?></span>
				<span class="author"><?= $song->Author; ?></span>
				<input type="hidden" value="<?php echo $song->Text?>">
			</td>
			<td><?= $song->Key; ?></td>
			<td><a href="<?= $song->YoutubeLink; ?>"><i class="fa fa-fw fa-video-camera"></i></a></td>
			<td><a href="songs/edit/<?= $song->id; ?>"><i class="fa fa-fw fa-edit"></i></a></td>
			</a>
		</tr>
	<?php }; ?>
	</tbody>
</table>



