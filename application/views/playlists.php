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
				<span class="title"><?= $playlist->Title; ?></span>
				<span class="author"><?= $playlist->UserID; ?></span>
				<span class="author"><?= $playlist->DateUpdated; ?></span>
				<input type="hidden" value="<?php echo $playlist->Listtext?>">
			</td>
			<td><?= $playlist->DateUpdated; ?></td>
			<td><a href="playlists/edit/<?= $playlist->id; ?>"><i class="fa fa-fw fa-edit"></i></a></td>
			</a>
		</tr>
	<?php }; ?>
	</tbody>
</table>



