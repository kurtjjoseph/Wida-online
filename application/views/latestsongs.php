<div>
	<?php foreach($latestsongs as $id => $song){?>
		<div>
			<div><a href="home?id=<?= $song->id;?>"><?= $song->Title;?></a> - <?= $song->Key;?></div>
			<div><?= $song->Author;?></div>
			<div><?= $song->Tempo;?> - <?= $song->Time;?></div>
			<div><pre><?= $song->Text;?></pre></div>
		</div>
	<?php  }; ?>
</div>


