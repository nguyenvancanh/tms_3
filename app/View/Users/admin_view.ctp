<div class="container">
    <h1><?php echo $title; ?></h1>
	<hr>
	<div class="row">
		<div class="col-md-10">
			<?php echo $this->Session->flash('notify'); ?>
			<?php if(isset($user)&&!empty($user)):?>
			<form class="form-horizontal col-md-offset-3" role="form">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('User name: '); ?></label>
					<div class="col-sm-8">
						<p class="form-control-static"><?php echo $user['User']['username']; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('Full name: '); ?></label>
					<div class="col-sm-8">
						<p class="form-control-static"><?php echo $user['User']['name']; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('Role: '); ?></label>
					<div class="col-sm-8">
						<p class="form-control-static"><?php echo $role[$user['User']['is_admin']]; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('Registered: '); ?></label>
					<div class="col-sm-8">
						<p class="form-control-static"><?php echo $user['User']['created']; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo __('Last update: '); ?></label>
					<div class="col-sm-8">
						<p class="form-control-static"><?php echo $user['User']['modified']; ?></p>
					</div>
				</div>
			</form>
			<?php else: ?>
			<p class="text-center text-warning"><?php echo __('User not found'); ?> </p>
			<?php endif;?>
		</div>
	</div>
</div>
<hr>