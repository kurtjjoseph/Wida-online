<form method="post" action="<?php echo site_url("songs/save/" . $selectedsong->id) ?>" class="form-horizontal">


	<div class="row">
		<div class="col-lg-8 col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-header" data-background-color="purple">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<span class="nav-tabs-title">Song edit:</span>
							<ul class="nav nav-tabs" data-tabs="tabs">
								<li class="active">
									<a href="#details" data-toggle="tab">
										<i class="material-icons">description</i> Details
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#text" data-toggle="tab">
										<i class="material-icons">subject</i> Text
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#text-preview" data-toggle="tab">
										<i class="material-icons">subject</i> Text Preview
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#chordinputtab" data-toggle="tab">
										<i class="material-icons">donut_large</i> Chords
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#pdf" data-toggle="tab">
										<i class="material-icons">picture_as_pdf</i> PDF
										<div class="ripple-container"></div>
									</a>
								</li>

							</ul>
						</div>
					</div>
				</div>
				<div class="card-content">
					<div class="tab-content">
						<div class="tab-pane active" id="details">

							<div class="row">
								<label class="col-sm-1 label-on-left">Title</label>
								<div class="col-sm-10">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id='Title' name='Title' type="text" class="form-control"
											   value="<?= $selectedsong->Title ?>">
										<span class="material-input"></span>
									</div>
								</div>

							</div>

							<div class="row">
								<label class="col-sm-1 label-on-left">Author</label>
								<div class="col-sm-10">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id = 'Author' name='Author' type="text" class="form-control"
											   value="<?= $selectedsong->Author ?>">

										<span class="material-input"></span></div>
								</div>
							</div>

							<div class="row">
								<label class="col-sm-1 label-on-left">Key</label>
								<div class="col-sm-2">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id = 'Key' name='Key' type="text" class="form-control"
											   value="<?= $selectedsong->Key ?>">

										<span class="material-input"></span></div>
								</div>
								<label class="col-sm-2 label-on-left">Tempo</label>
								<div class="col-sm-2">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id = 'Tempo' name='Tempo' type="text" class="form-control"
											   value="<?= $selectedsong->Tempo ?>">

										<span class="material-input"></span></div>
								</div>
								<label class="col-sm-2 label-on-left">Tijdsindeling</label>
								<div class="col-sm-2">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id = 'Time'  name='Time' type="text" class="form-control"
											   value="<?= $selectedsong->Time ?>">

										<span class="material-input"></span></div>
								</div>

							</div>

							<div class="row">
								<label class=" col-sm-1 label-on-left">Youtube</label>
								<div class="col-sm-10">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id="youtubelink" name='YoutubeLink' type="text" class="form-control"
											   value="<?= $selectedsong->YoutubeLink ?>">
										<span class="material-input"></span></div>
								</div>
							</div>

							<div class="row">
								<h3>Cover video's</h3>
								<label class="col-sm-1 label-on-left">Drum cover</label>
								<div class="col-sm-4">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id="drumcover" name='drumcover' type="text" class="form-control"
											   value="<?= $selectedsong->drumcover ?>">
										<span class="material-input"></span></div>
								</div>
								<label class="col-sm-1 label-on-left">Bass cover</label>
								<div class="col-sm-5">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id="basscover" name='basscover' type="text" class="form-control"
											   value="<?= $selectedsong->basscover ?>">
										<span class="material-input"></span></div>
								</div>
							</div>

							<div class="row">

								<label class="col-sm-1 label-on-left">Ac Guitar cover</label>
								<div class="col-sm-4">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id="acguitarcover" name='acguitarcover' type="text" class="form-control"
											   value="<?= $selectedsong->acguitarcover ?>">
										<span class="material-input"></span></div>
								</div>
								<label class="col-sm-1 label-on-left">El Guitar cover</label>
								<div class="col-sm-5">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id="elguitarcover" name='elguitarcover' type="text" class="form-control"
											   value="<?= $selectedsong->elguitarcover ?>">
										<span class="material-input"></span></div>
								</div>
							</div>
							<div class="row">

								<label class="col-sm-1 label-on-left">Piano cover</label>
								<div class="col-sm-4">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id="pianocover" name='pianocover' type="text" class="form-control"
											   value="<?= $selectedsong->pianocover ?>">
										<span class="material-input"></span></div>
								</div>
								<label class="col-sm-1 label-on-left">Zang Cover</label>
								<div class="col-sm-5">
									<div class="form-group label-floating is-empty">
										<label class="control-label"></label>
										<input id="zangcover" name='zangcover' type="text" class="form-control"
											   value="<?= $selectedsong->zangcover ?>">
										<span class="material-input"></span></div>
								</div>
							</div>
							<div class="row">
								<div class="text-right">


									<button class="btn btn-fill btn-default  btn-sm" type="button"
											onclick="history.back()">
										<i class="fa fa-fw fa-arrow-left"></i>Terug
									</button>
									<button type="submit" class="btn btn-fill btn-success btn-sm">
										<i class="fa fa-fw fa-save"></i> Opslaan
									</button>
								</div>
							</div>


						</div>
						<div class="tab-pane" id="text">
							<div class="row">
								<label class="col-sm-1 label-on-left"></label>
								<div class="">
									<label class="control-label"></label>
									<textarea id="songtext" name='Text' class="mat-input-element"
											  style="font-family: Monospace;" rows="30"><?= $selectedsong->Text ?>
								</textarea>
								</div>
							</div>

							<div class="row">
								<div class="text-right">
									<button class="btn btn-fill btn-default  btn-sm" type="button"
											onclick="history.back()">
										<i class="fa fa-fw fa-arrow-left"></i>Terug
									</button>
									<button type="submit" class="btn btn-fill btn-success btn-sm">
										<i class="fa fa-fw fa-save"></i> Opslaan
									</button>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="text-preview">
							<div id="textpreview" class="preformatted ps-active-y"></div>
						</div>
						<div class="tab-pane" id="chordinputtab">
							<div class="row">
								<div class="12">
							<textarea id="chordinput" name='Data' class="mat-input-element"
									  style="font-family: Monospace;" rows="30"><?= $selectedsong->Data ?></textarea>
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
									<button class="btn btn-fill btn-default  btn-sm" type="button"
											onclick="history.back()">
										<i class="fa fa-fw fa-arrow-left"></i>Terug
									</button>
									<button type="submit" class="btn btn-fill btn-success btn-sm">
										<i class="fa fa-fw fa-save"></i> Opslaan
									</button>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="pdf">
							<div id="textpreviewpdf" class="">
								<iframe class="preview-pane" type="application/pdf" width="100%" height="650"
										frameborder="0" style="position:relative;z-index:999"
										></iframe>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-6 col-sm-6">
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
			<div class="card card-nav-tabs">
				<div class="card-header" data-background-color="purple">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<span class="nav-tabs-title">Chords:</span>
							<ul class="nav nav-tabs" data-tabs="tabs">

								<li class="">
									<a href="#chords-preview" data-toggle="tab">
										<i class="fa fa-fw"><img style="height:19px; position:relative; top:-2px;"
																 src="/wida-online/assets/common/img/pianochords.png"></i>
										Chords
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#pianochords" data-toggle="tab">
										<i class="fa fa-fw"><img style="height:19px; position:relative; top:-2px;"
																 src="/wida-online/assets/common/img/pianochords.png"></i>
										Piano
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#guitarchords" data-toggle="tab">
										<i class="fa fa-fw"><img style="height:19px; position:relative; top:-2px;"
																 src="/wida-online/assets/common/img/guitarchord.png"></i>
										Guitar
										<div class="ripple-container"></div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card-content">
					<div class="tab-content">


						<div class="tab-pane" id="chords-preview">
							<div id="chords" class=""></div>
						</div>

						<div class="tab-pane" id="guitar">
							<div id="guitarchords" class=""></div>
						</div>

						<div class="tab-pane" id="piano">
							<div id="pianochords" class=""></div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>


</form>


<script>
	setPreview();
</script>
