<style>
	#playlists tr{
		cursor: pointer;
	}
</style>
<div class="col-lg-6 col-md-6 col-sm-6">
	<div class="card" >
		<div class="card-header card-header-text" data-background-color="purple">
			<table width="100%">
				<tr>
					<td>
						<h4 class="card-title "><?= $selectedplaylist->title ?> - <span id="selectedKey"><?= $selectedplaylist->dateScheduled ?></span></h4>
					</td>
					<td class="text-right">
						<button id="pdfdownload" class="btn btn-purple btn-round btn-sm" type="button" title="Download pdf" rel="tooltip" data-original-title="Download pdf">
							<i class="fa fa-fw fa-file-pdf-o"></i>
						</button>

						<a  href="<?php echo site_url('/') ?>playlists/edit/<?= $selectedplaylist->id; ?>">
							<button id="editplaylist" class="btn btn-purple btn-round btn-sm" type="button" title="Edit playlist" rel="tooltip" data-original-title="Edit Playlist">
								<i class="fa fa-fw fa-edit"></i>
							</button>
						</a>

					</td>
				</tr>
			</table>
		</div>
		<div class="card-content">
			<div class="row">
				<input type="hidden" id="id" value="<?= $selectedplaylist->id ?>">
				<input type="hidden" id="title" value="<?= $selectedplaylist->title ?>">
				<input type="hidden" id="userID" value="<?= $selectedplaylist->userID ?>">
				<input type="hidden" id="dateUpdated" value="<?= $selectedplaylist->dateUpdated ?>">
				<input type="hidden" id="dateScheduled" value="<?= $selectedplaylist->dateScheduled ?>">
				<input type="hidden" id="listtext" value="<?= $selectedplaylist->listtext ?>">
				<input type="hidden" id="description" value="<?= $selectedplaylist->description ?>">
				<input type="hidden" id="eventId" value="<?= $selectedplaylist->eventId ?>">
				<div style="height:650px; overflow-y:scroll; overflow-x: hidden;">
				<div id="textpreview" class="preformatted"><?= $selectedplaylist->listtext ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

