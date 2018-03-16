<nav class="navbar navbar-transparent navbar-absolute">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo site_url($pagelink) ?>"> <?= $pagetitle ?> </a>
			<?php if($pageaddlink){ ?>
				<a class="navbar-brand" href="<?php echo site_url($pageaddlink) ?>"> <i class="material-icons">add</i> Nieuw</a>
			<?php }; ?>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="<?php echo site_url('/berichten') ?>" class="dropdown-toggle" data-toggle="dropdown">
						<i class="material-icons">notifications</i>
						<span class="notification">5</span>
						<p class="hidden-lg hidden-md">berichten</p>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Mike John responded to your email</a>
						</li>
						<li>
							<a href="#">You have 5 new tasks</a>
						</li>
						<li>
							<a href="#">You're now friend with Andrew</a>
						</li>
						<li>
							<a href="#">Another Notification</a>
						</li>
						<li>
							<a href="#">Another One</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
						<i class="material-icons">person</i>
						<p class="hidden-lg hidden-md">Profiel</p>
					</a>
				</li>
			</ul>
			<form class="navbar-form navbar-right" role="search">
				<div class="form-group  is-empty">
					<input type="text" class="form-control" placeholder="Search">
					<span class="material-input"></span>
				</div>
				<button type="submit" class="btn btn-white btn-round btn-just-icon">
					<i class="material-icons">search</i>
					<div class="ripple-container"></div>
				</button>
			</form>
		</div>
	</div>
</nav>
