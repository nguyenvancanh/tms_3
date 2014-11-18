<div class="container">
    <h1><?php echo $title; ?></h1>
	<hr>
	<div class="row">
		<div class="col-md-10 col-md-offset-2">
			<?php echo $this->Session->flash('notify'); ?>
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('User name: '); ?></label>
					<div class="col-sm-10">
						<p class="form-control-static"><?php echo $user['User']['username']; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('Full name: '); ?></label>
					<div class="col-sm-10">
						<p class="form-control-static"><?php echo $user['User']['name']; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('Registered: '); ?></label>
					<div class="col-sm-10">
						<p class="form-control-static"><?php echo $user['User']['created']; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('Last update: '); ?></label>
					<div class="col-sm-10">
						<p class="form-control-static"><?php echo $user['User']['modified']; ?></p>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<hr>