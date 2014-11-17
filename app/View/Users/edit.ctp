<div class="container">
    <h1><?php echo __('Edit Profile'); ?></h1>
	<hr>
	<div class="row">
		<div class="col-md-9 personal-info">
			<h3><?php echo __('Personnal info'); ?></h3>
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
				'role' => 'form',
				'novalidate' => true
			]);
			echo $this->Form->input('User.id', ['type' => 'hidden']);
			echo $this->Form->input('username', ['class' => 'form-control']);
			echo $this->Form->input('name', ['class' => 'form-control']);
			$submitOptions = [
				'label' => __('Save change'),
				'div' => ['class' => 'col-md-offset-3 col-md-9 '],
				'class' => 'btn btn-lg btn-primary'
			];
			echo $this->Form->end($submitOptions);
			?>
		</div>
	</div>
</div>
<hr>