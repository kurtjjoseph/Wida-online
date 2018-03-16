<form method="post" action="<?php echo site_url("songs/save/" . $selectedsong->id) ?>" class="form-horizontal">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="card">
				<div class="card-header card-header-text" data-background-color="purple">
					<h4 class="card-title">Edit: <?= $selectedsong->Title ?></h4>
				</div>
				<div class="card-content">
					<div class="row">
						<label class="col-sm-1 label-on-left">Title</label>
						<div class="col-sm-10">
							<div class="form-group label-floating is-empty">
								<label class="control-label"></label>
								<input name='Title' type="text" class="form-control"
									   value="<?= $selectedsong->Title ?>">

								<span class="material-input"></span></div>
						</div>
					</div>

					<div class="row">
						<label class="col-sm-1 label-on-left">Author</label>
						<div class="col-sm-10">
							<div class="form-group label-floating is-empty">
								<label class="control-label"></label>
								<input name='Author' type="text" class="form-control"
									   value="<?= $selectedsong->Author ?>">

								<span class="material-input"></span></div>
						</div>
					</div>

					<div class="row">
						<label class="col-sm-1 label-on-left">Key</label>
						<div class="col-sm-2">
							<div class="form-group label-floating is-empty">
								<label class="control-label"></label>
								<input name='Key' type="text" class="form-control" value="<?= $selectedsong->Key ?>">

								<span class="material-input"></span></div>
						</div>
						<label class="col-sm-2 label-on-left">Tempo</label>
						<div class="col-sm-2">
							<div class="form-group label-floating is-empty">
								<label class="control-label"></label>
								<input name='Tempo' type="text" class="form-control"
									   value="<?= $selectedsong->Tempo ?>">

								<span class="material-input"></span></div>
						</div>
						<label class="col-sm-2 label-on-left">Tijdsindeling</label>
						<div class="col-sm-2">
							<div class="form-group label-floating is-empty">
								<label class="control-label"></label>
								<input name='Time' type="text" class="form-control" value="<?= $selectedsong->Time ?>">

								<span class="material-input"></span></div>
						</div>

					</div>

					<div class="row">
						<label class="col-sm-1 label-on-left">Youtube</label>
						<div class="col-sm-10">
							<div class="form-group label-floating is-empty">
								<label class="control-label"></label>
								<input id="youtubelink" name='YoutubeLink' type="text" class="form-control"
									   value="<?= $selectedsong->YoutubeLink ?>">
								<span class="material-input"></span></div>
						</div>
					</div>

					<div class="row">
						<div class="text-right">


							<button class="btn btn-fill btn-default  btn-sm" type="button" onclick="history.back()">
								<i class="fa fa-fw fa-arrow-left"></i>Terug
							</button>
							<button type="submit" class="btn btn-fill btn-success btn-sm">
								<i class="fa fa-fw fa-save"></i> Opslaan
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="card">
				<div class="card-header card-header-text" data-background-color="purple">
					<h4 class="card-title">Youtube</h4>
				</div>
				<div class="card-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="youtube-preview"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="card" style="height:484px;">
				<div class="card-header card-header-text" data-background-color="purple">
					<h4 class="card-title">Text</h4>
				</div>
				<div class="card-content">
					<div class="row">
						<label class="col-sm-1 label-on-left"></label>
						<div class="">
							<label class="control-label"></label>
							<textarea id="songtext" name='Text' class="mat-input-element"
									  style="font-family: Monospace;" rows="15"><?= $selectedsong->Text ?>
								</textarea>
						</div>
					</div>

					<div class="row">
						<div class="text-right">
							<button class="btn btn-fill btn-default  btn-sm" type="button" onclick="history.back()">
								<i class="fa fa-fw fa-arrow-left"></i>Terug
							</button>
							<button type="submit" class="btn btn-fill btn-success btn-sm">
								<i class="fa fa-fw fa-save"></i> Opslaan
							</button>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="card" style="height:484px; ">
				<div class="card-header card-header-text" data-background-color="purple">
					<h4 class="card-title">Song Preview</h4>
				</div>
				<div class="card-content">
					<div class="row">
						<div class="12">
							<div id="textpreview" class="">
								<?= $selectedsong->Text ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header card-header-text" data-background-color="purple">
					<h4 class="card-title">Chord input</h4>
				</div>
				<div class="card-content">
					<div class="row">
						<div class="12">
							<textarea id="chordinput" name='Data' class="mat-input-element"
									  style="font-family: Monospace;" rows="15"><?= $selectedsong->Data ?></textarea>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<button id="fillchords" class="btn btn-fill btn-default  btn-sm" type="button">
								<i class="fa fa-fw fa-arrow-down"></i>Fill Chords
							</button>
							<button id="updatechords" class="btn btn-fill btn-default btn-sm" type="button">
								<i class="fa fa-fw fa-refresh"></i> Update Chords
							</button>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 text-right">
							<button class="btn btn-fill btn-default  btn-sm" type="button" onclick="history.back()">
								<i class="fa fa-fw fa-arrow-left"></i>Terug
							</button>
							<button type="submit" class="btn btn-fill btn-success btn-sm">
								<i class="fa fa-fw fa-save"></i> Opslaan
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header card-header-text" data-background-color="purple">
					<h4 class="card-title">Song Chords</h4>
				</div>
				<div class="card-content">
					<div class="row">
						<div class="12">
							<div id="chords" class="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header card-header-text" data-background-color="purple">
					<h4 class="card-title">Song PDF</h4>
				</div>
				<div class="card-content">
					<div class="row">
						<div class="12">
							<div id="textpreviewpdf" class="">
								<iframe class="preview-pane" type="application/pdf" width="100%" height="680px"
										frameborder="0" style="position:relative;z-index:999"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<table>
		<tr>
			<td>
				<button>E</button>
			</td>
			<td>
				<button>Bar</button>
			</td>
			<td>
				<button>A</button>
			</td>
			<td>
				<button>bar</button>
			</td>
			<td>
				<button>D</button>
			</td>
			<td>
				<button></button>
			</td>
			<td>
				<button>G</button>
			</td>
			<td>
				<button></button>
			</td>
			<td>
				<button>B</button>
			</td>
			<td>
				<button>Bar</button>
			</td>
			<td>
				<button>E</button>
			</td>
		</tr>
	</table>

</form>


