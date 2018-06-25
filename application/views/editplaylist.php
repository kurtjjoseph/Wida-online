<script>

	var userlist =<?php echo json_encode($userlist); ?>;
	var songlist =<?php echo json_encode($songlist); ?>;


	var playlistsongs = <?php if(isset($selectedplaylist->playlistsongs))echo json_encode($selectedplaylist->playlistsongs); ?>;


</script>

<form method="post" action="<?php echo site_url("playlists/save/" . $selectedplaylist->id) ?>" class="form-horizontal">


	<div class="row">
		<div class="col-lg-6 ">
			<div class="card card-nav-tabs">
				<div class="card-header" data-background-color="purple">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<span class="nav-tabs-title">Playlist edit:</span>
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
						<div class="tab-pane active" id="details" style="height:700px;">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group label-floating is-empty">
										<label class="control-label">Title</label>
										<input type="text" class="form-control" id="title" name='title' type="text"

											   class="form-control" value="<?= $selectedplaylist->title ?>">
										<span class="material-input"></span>
									</div>
								</div>
							</div>
							<div class="row">

								<div class="col-sm-12">
									<div class="form-group label-floating is-empty">
										<label class="control-label">Description</label>
										<input type="text" class="form-control" id="description" name='description'

											   value="<?= $selectedplaylist->description ?>">
										<span class="material-input"></span></div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-1">Date Scheduled</label>
								<div class="col-sm-5">
									<div class="form-group label-floating is-empty">
										<input type="text" class="form-control datetimepicker" id="dateScheduled"
											   name='dateScheduled' type="text" class="form-control"
											   value="<?= $selectedplaylist->dateScheduled ?>">
										<span class="material-input"></span>
									</div>
								</div>
								<label class="col-sm-1">User</label>
								<div class="col-sm-5">
									<div id="userid" class=" form-group label-floating is-empty ">

										<select class="selectpicker show-tick form-control" data-selected-text-format="count" id="userID" name='userID'>
											<?php foreach ($userlist as $id => $user) { ?>
												<option value="<?= $id;?>"><?= $user->naam;?></option>
											<?php }; ?>
										</select>
										<span class="material-input"></span>
									</div>

								</div>

							</div>

							<div class="row">
								<h3>Liederen</h3>


								<div id="table" class="col-sm-12 table-editable">

									<table class=" col-sm-12 ">
										<tr>
											<th>Title</th>
											<th >Key</th>
											<th ></th>
											<th ></th>
										</tr>
										<tr>
											<td><input class="songsearch " type="text" name="songtitle[]" placeholder="Zoek een lied"></td>
											<td><input class="songkey" type="text" name="songkey[]" value="C"></td>
											<td colspan="3">
												<button class="btn btn-fill btn-primary  btn-sm table-add" type="button" onclick="return false">
													<i class="fa fa-fw fa-plus"></i>Add Song
												</button>
											</td>
										</tr>


										<?php if(isset($selectedplaylist->playlistsongs)){foreach ($selectedplaylist->playlistsongs as $item) {    $song = $songlist[$item->id];  ?>
											<tr class="songlistrow">

													<input class="songiddata" type="hidden" name="playlistsongs[id][]" value="<?= $item->id;?>"/>
													<input class="songkeydata" type="hidden" name="playlistsongs[key][]"  value="<?= $item->key;?>"  />

													<td class="songtitle"><?= $song->Title;?></td>
													<td maxlength="2" class="songkey"><?= $item->key;?></td>
													<td>
														<span class="table-remove glyphicon glyphicon-remove "></span>
													</td>
													<td>
														<span class="table-up glyphicon glyphicon-arrow-up "></span>
														<span class="table-down glyphicon glyphicon-arrow-down "></span>
													</td>
											</tr>
										<?php }}; ?>




										<!-- This is our clonable table line -->
										<tr class="hide songlistrow">


												<td class="songtitle"></td>
												<td maxlength="2" class="songkey"></td>
												<td>
													<span class="table-remove glyphicon glyphicon-remove "></span>
												</td>
												<td>
													<span class="table-up glyphicon glyphicon-arrow-up "></span>
													<span class="table-down glyphicon glyphicon-arrow-down "></span>
												</td>
										</tr>
									</table>

								</div>

								<button id="export-btn" class="btn btn-primary">Export Data</button>
								<p id="export"></p>

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
									<textarea id="playlisttext" name='Text' class="mat-input-element"
											  style="font-family: Monospace;"
											  rows="30"><?= $selectedplaylist->Text ?>
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
									  style="font-family: Monospace;"
									  rows="30"><?= $selectedplaylist->Data ?></textarea>
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

		<div class="col-lg-6 col-md-6 col-sm-6">
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

