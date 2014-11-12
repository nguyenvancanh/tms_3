<header class="navbar navbar-static-top navbar-inverse" id="top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?= $this->Html->link(__('Training System'), '/', ['class' => 'navbar-brand']) ?>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav navbar-right">
				<li><?= $this->Html->link(__('Login'), '/login') ?></li>
				<li><?= $this->Html->link(__('Register'), '/register') ?></li>
			</ul>
		</nav>
	</div>
</header>