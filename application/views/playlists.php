<style>
	#playlists tr{
		cursor: pointer;
	}
</style>
<div class="row">
<div class="col-sm-6"><input class="form-control label-floating" type="text" id="myInput" onkeyup="filter()" placeholder="Zoek een playlist ... " /></div>
<div class="col-sm-6"><input class="form-control label-floating" type="text" id="key" onkeyup="filter()" placeholder="Key"/></div>
</div>
<table id="songs" class="playlists table table-sm table-hover table-striped">
	<thead>
	<tr>
		<th scope="col">Title</th>
		<th scope="col">Userid</th>
		<th scope="col">Acties</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($playlists as $id => $playlist) { ?>
		<tr onclick="location.href='playlists/playlist/<?= $playlist->id; ?>';">
			<td>
				<span class="title"><?= $playlist->title; ?></span>
				<span class="author"><?= $playlist->userID; ?></span>
				<span class="author"><?= $playlist->dateUpdated; ?></span>
				<input type="hidden" value="<?php echo $playlist->listtext?>">
			</td>
			<td><?= $playlist->dateUpdated; ?></td>
			<td><a href="playlists/edit/<?= $playlist->id; ?>"><i class="fa fa-fw fa-edit"></i></a></td>
			</a>
		</tr>
	<?php }; ?>
	</tbody>
</table>



