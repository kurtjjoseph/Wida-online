<div class="col-lg-6 col-md-6 col-sm-6">
	<div class="card" style="height:850px; ">
		<div class="card-header card-header-text" data-background-color="purple">
			<table width="100%">
				<tr>
					<td>
						<h4 class="card-title "><?= $selectedsong->Title ?></h4>
					</td>
					<td class="text-right">
						<a class="btn btn-success btn-round btn-sm" href="<?php echo site_url('/') ?>songs/edit/<?= $selectedsong->id; ?>"><i
								class="fa fa-fw fa-edit"></i>Edit</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="card-content">
			<div class="row">
				<div class="12">
					<div id="songtext" class="">
						<?= $selectedsong->Text ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
	<div class="card">
		<input id="youtubelink" name='YoutubeLink' type="hidden" value="<?= $selectedsong->YoutubeLink ?>">
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
</div>
