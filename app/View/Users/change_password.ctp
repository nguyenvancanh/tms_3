<div class="container">
    <h1><?php echo __('Change Password'); ?></h1>
	<hr>
	<div class="row">
		<div class="col-md-9 personal-info">
			<?php echo $this->Session->flash('notify'); ?>
			<?php
			$labelOptions = ['class' => 'control-label col-md-3'];
			echo $this->Form->create(null, [
				'class' => 'form-horizontal',
				'inputDefaults' => [
					'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
					'div' => ['class' => 'form-group'],
					'label' => $labelOptions,
					'between' => '<div class="col-md-9">',
					'after' => '</div>',
					'error' => [
						'attributes' => [
							'wrap' => 'span',
							'class' => 'help-inline text-danger'
						]
					],
				],
				'novalidate' => true,
				'role' => 'form'
			]);
			echo $this->Form->input('old_password', ['class' => 'form-control', 'type' => 'password']);
			echo $this->Form->input('password', ['class' => 'form-control']);
			echo $this->Form->input('password_confirm', ['class' => 'form-control', 'type' => 'password']);
			$submitOptions = [
				'label' => __('Change'),
				'div' => ['class' => 'col-md-offset-3 col-md-9 '],
				'class' => 'btn btn-lg btn-primary'
			];
			echo $this->Form->end($submitOptions);
			?>
		</div>
	</div>
</div>
<hr>