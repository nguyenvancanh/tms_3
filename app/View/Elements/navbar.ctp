<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php
		if (CustomAuthComponent::user('is_admin')):
			echo $this->Html->link(__('Admin Management'), '/', ['class' => 'navbar-brand']);
		else:
			echo $this->Html->link(__('Training System'), '/', ['class' => 'navbar-brand']);
		endif;
		?>
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
				<i class="fa fa-user fa-fw"></i><?php echo CustomAuthComponent::user('name'); ?>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><?php echo $this->Html->link('<i class="fa fa-user fa-fw"></i>&nbsp' . __('View Profile'), '/users/view', ['escape' => false]); ?></li>
				<li><?php echo $this->Html->link('<i class="fa fa-key fa-fw"></i>&nbsp' . __('Edit Password'), '/edit/password', ['escape' => false]); ?></li>
			</ul>
		</li>
		<li class="divider"></li>
		<li><?php echo $this->Html->link('<i class="fa fa-sign-out fa-fw"></i>&nbsp' . __('Logout'), '/logout', ['escape' => false]); ?></li>
	</ul>
	<!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li><?php echo $this->Html->link('<i class="fa fa-home fa-fw"></i>&nbsp' . __('Dashboard'), '/dashboard', ['escape' => false]); ?></li>
			<li>
				<a href="#"><i class="fa fa-cog fa-fw"></i>&nbsp;<?php echo __('Settings'); ?><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><?php echo $this->Html->link(__('Basic Info'), '/users/view', ['escape' => false]); ?></li>
					<li><?php echo $this->Html->link(__('Edit Profile'), '/edit/profile', ['escape' => false, 'id' => 'EditProfile']); ?></li>
					<li><?php echo $this->Html->link(__('Change Password'), '/edit/password', ['escape' => false, 'id' => 'EditPassword']); ?></li>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li class="active">
				<a href="#"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;<?php echo __('Report'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><?php echo $this->Html->link(__('Write'), ['controller' => 'reports', 'action' => 'add', 'admin' => false], ['escape' => false]); ?></li>
					</ul>
				</li>
			<li>
				<a href="#"><i class="fa fa-list-alt fa-fw"></i>&nbsp;<?php echo __('Subjects'); ?><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><?php echo $this->Html->link(__('Progress'), '/subjects/progress', ['escape' => false]); ?></li>
					<li><?php echo $this->Html->link(__('All Subjects'), '/subjects', ['escape' => false]); ?></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-book fa-fw"></i>&nbsp;<?php echo __('Courses'); ?><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><?php echo $this->Html->link(__('All Courses'), '/courses', ['escape' => false]); ?></li>
					<li><?php echo $this->Html->link(__('Courses Joined'), '/courses/joined', ['escape' => false]); ?></li>

				</ul>
			</li>
			<?php if (CustomAuthComponent::user('is_admin')): ?>
				<li>
					<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo __('Manage Users'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><?php echo $this->Html->link(__('Add User'), ['controller' => 'users', 'action' => 'add', 'admin' => true], ['escape' => false]); ?></li>
						<li><?php echo $this->Html->link(__('Manage Users'), ['controller' => 'users', 'action' => 'index', 'admin' => true], ['escape' => false]); ?></li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#"><i class="fa fa-list-alt fa-fw"></i>&nbsp;<?php echo __('Manage Subjects'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><?php echo $this->Html->link(__('Add Subjects'), ['controller' => 'subjects', 'action' => 'add', 'admin' => true], ['escape' => false]); ?></li>
						<li><?php echo $this->Html->link(__('Manage Subjects'), ['controller' => 'subjects', 'action' => 'index', 'admin' => true], ['escape' => false]); ?></li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-book fa-fw"></i>&nbsp;<?php echo __('Manage Courses'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><?php echo $this->Html->link(__('Add Courses'), ['controller' => 'courses', 'action' => 'add', 'admin' => true], ['escape' => false]); ?></li>
						<li><?php echo $this->Html->link(__('Add Users'), ['controller' => 'courses', 'action' => 'add', 'admin' => true, 'user'], ['escape' => false]); ?></li>
						<li><?php echo $this->Html->link(__('Remove Member'), ['controller' => 'courses', 'action' => 'delete', 'admin' => true, 'user'], ['escape' => false]); ?></li>
						<li><?php echo $this->Html->link(__('Manage Courses'), ['controller' => 'courses', 'action' => 'index', 'admin' => true], ['escape' => false]); ?></li>
					</ul>
				</li>
			<?php endif; ?>
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>