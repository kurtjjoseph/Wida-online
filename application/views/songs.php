<div>
	<?php foreach($songs as $id => $song){?>
		<div>
			<div><a href="home?id=<?= $song->id;?>"><?= $song->Title;?></a> - <?= $song->Key;?></div>
		</div>
	<?php  }; ?>
</div>


