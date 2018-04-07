<div class="col-lg-6 col-md-6 col-sm-6">
	<div class="card" >
		<div class="card-header card-header-text" data-background-color="purple">
			<table width="100%">
				<tr>
					<td>
						<h4 class="card-title "><?= $selectedsong->Title ?></h4>
					</td>
					<td class="text-right">
						<button id="trans-up" class="btn btn-purple btn-round btn-sm" type="button" title="Transpose up" rel="tooltip" data-original-title="Transpose up">
							<i class="fa fa-fw fa-hashtag"></i>
						</button>
						<button id="trans-down" class="btn btn-purple btn-round btn-sm" type="button" title="Transpose down" rel="tooltip" data-original-title="Transpose down">
							<i class="fa fa-fw"><img style="height:19px; position:relative; top:-2px;" src="/wida-online/assets/common/img/b.png"></i>
						</button>
						<a  href="<?php echo site_url('/') ?>songs/edit/<?= $selectedsong->id; ?>">
						<button id="trans-down" class="btn btn-purple btn-round btn-sm" type="button" title="Edit song" rel="tooltip" data-original-title="Edit Song">
							<i class="fa fa-fw fa-edit"></i>
						</button>
						</a>

					</td>
				</tr>
			</table>
		</div>
		<div class="card-content">
			<div class="row">
				<input type="hidden" id="songtext" value="<?= $selectedsong->Text ?>">
				<input type="hidden" id="Author" value="<?= $selectedsong->Author ?>">
				<input type="hidden" id="Key" value="<?= $selectedsong->Key ?>">
				<input type="hidden" id="Tempo" value="<?= $selectedsong->Tempo ?>">
				<input type="hidden" id="Time" value="<?= $selectedsong->Time ?>">
				<div style="height:650px; overflow-y:scroll; overflow-x: hidden;">
					<div id="textpreview" class="preformatted"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
	<div class="card">
		<input id="youtubelink" name='YoutubeLink' type="hidden" value="<?= $selectedsong->YoutubeLink ?>">
		<input id="drumcover" name='drumcover' type="hidden" value="<?= $selectedsong->drumcover ?>">
		<input id="basscover" name='basscover' type="hidden" value="<?= $selectedsong->basscover ?>">
		<input id="zangcover" name='zangcover' type="hidden" value="<?= $selectedsong->zangcover ?>">
		<input id="pianocover" name='pianocover' type="hidden" value="<?= $selectedsong->pianocover ?>">
		<input id="elguitarcover" name='elguitarcover' type="hidden" value="<?= $selectedsong->elguitarcover ?>">
		<input id="acguitarcover" name='acguitarcover' type="hidden" value="<?= $selectedsong->acguitarcover ?>">
		<div class="card-header card-header-text" data-background-color="purple">
			<h4 class="card-title">Youtube</h4>
		</div>
		<div class="card-content">
			<div class="row">
				<div class="">
					<div class="youtube-preview"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header card-header-text" data-background-color="purple">
			<h4 class="card-title">Chords</h4>
		</div>
		<div class="card-content">
			<div class="row">
				<div class="">
					<div class="chords"></div>
				</div>
			</div>
		</div>
	</div>
</div>
