<div class="table-responsive">
<table id="songs" class="table table-hover table-striped">
	<thead>
	<tr>
		<th scope="col">Title</th>
		<th scope="col">Key</th>
		<th scope="col">Youtube</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($songs as $id => $song){?>
		<tr>
			<td >
				<div><a href="songs/song/<?= $song->id;?>"><?= $song->Title;?></a></div>
				<div><?= $song->Author;?></a></div>
			</td>
			<td><?= $song->Key;?></td>
			<td><a href="<?= $song->YoutubeLink;?>"><i class="fa fa-fw fa-video-camera"></i></a></td>
			</a>
		</tr>
	<?php  }; ?>
	</tbody>
</table>
</div>



