<ul class="nav">
	<li <?php echo ($this->uri->segment(1)=="home") || ($this->uri->segment(1)=="") ? "class='active'":""?> >
		<a href="<?php echo site_url('/home') ?>" >
			<i class="material-icons">dashboard</i>
			<p>Overzicht</p>
		</a>
	</li>
	<li <?php echo $this->uri->segment(1)=="songs"? "class='active'":""?>>
		<a href="<?php echo site_url('/songs') ?>">
			<i class="material-icons">music_note</i>
			<p>Liederen</p>
		</a>
	</li>
	<li <?php echo $this->uri->segment(1)=="playlists"? "class='active'":""?>>
		<a href="<?php echo site_url('/playlists') ?>">
			<i class="material-icons">queue_music</i>
			<p>Playlists</p>
		</a>
	</li>
	<li <?php echo $this->uri->segment(1)=="leden"? "class='active'":""?>>
		<a href="<?php echo site_url('/leden') ?>">
			<i class="material-icons">group_work</i>
			<p>Leden</p>
		</a>
	</li>
	<li <?php echo $this->uri->segment(1)=="rooster"? "class='active'":""?>>
		<a href="<?php echo site_url('/rooster') ?>">
			<i class="material-icons">date_range</i>
			<p>Rooster</p>
		</a>
	</li>
	<li <?php echo $this->uri->segment(1)=="planning"? "class='active'":""?>>
		<a href="<?php echo site_url('/planning') ?>">
			<i class="material-icons">event</i>
			<p>Planning</p>
		</a>
	</li>
	<li <?php echo $this->uri->segment(1)=="meldingen"? "class='active'":""?>>
		<a href="<?php echo site_url('/meldingen') ?>">
			<i class="material-icons text-gray">notifications</i>
			<p>Meldingen</p>
		</a>
	</li>

</ul>




