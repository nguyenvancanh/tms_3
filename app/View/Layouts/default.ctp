<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			<?php echo $this->fetch('title'); ?>
		</title>
		<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css([
			'bootstrap.min',
			'plugins/metisMenu/metisMenu.min.css',
			'sb-admin-2.css',
			'font-awesome-4.1.0/css/font-awesome.min.css',
			'style'
		]);
		echo $this->Html->script([
			'jquery',
			'bootstrap.min',
			'plugins/metisMenu/metisMenu.min',
			'sb-admin-2.js'
		]);
		?>
		<!--[if lt IE 9]>
		<script src = "https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php if (CustomAuthComponent::isLogged()): ?>
			<div id="wrapper">
				<?php echo $this->element('navbar') ?>
				<div id="page-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<?php echo $this->fetch('content'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php echo $this->element('default/navbar') ?>
			<div class="container">
				<?php echo $this->fetch('content'); ?>
			</div>
		<?php endif; ?>

	</body>
</html>
