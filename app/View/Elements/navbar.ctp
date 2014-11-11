<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.html"><?= __('Home'); ?></a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-messages">
				<li>
				</li>
			</ul>
			<!-- /.dropdown-messages -->
		</li>
		<!-- /.dropdown -->
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-tasks">

			</ul>
			<!-- /.dropdown-alerts -->
		</li>
		<!-- /.dropdown -->
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">

			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
					<a href="#"><i class="fa fa-home fa-fw"></i>&nbsp;<?= __('Dashboard'); ?></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-cog fa-fw"></i>&nbsp;<?= __('Settings'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="#"></i>&nbsp;<?= __('Profiles'); ?></a>
						</li>
						<li>
							<a href="#"></i>&nbsp;<?= __('Change password'); ?></a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-tasks fa-fw"></i>&nbsp;<?= __('Tasks'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="#"></i>&nbsp;<?= __('Default'); ?></a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-book fa-fw"></i>&nbsp;<?= __('Courses'); ?></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-list-alt fa-fw"></i>&nbsp;<?= __('Subjects'); ?></a>
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>