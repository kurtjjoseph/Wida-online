<div>
	<?php foreach($songs as $id => $song){?>
		<div>
			<div><a href="songs/song/<?= $song->id;?>"><?= $song->Title;?></a> - <?= $song->Key;?></div>
		</div>
	<?php  }; ?>
</div>


