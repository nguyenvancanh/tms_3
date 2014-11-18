<div class="container">
    <h1><?php echo $title; ?></h1>
	<hr>
	<div class="row">
		<div class="col-md-9 personal-info">
			<?php
			echo $this->Session->flash('notify');
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
			echo $this->Form->input('User.id', ['type' => 'hidden']);
			echo $this->Form->input('username', ['class' => 'form-control']);
			echo $this->Form->input('name', ['class' => 'form-control']);
			echo $this->Form->input('is_admin', [
				'type' => 'select',
				'options' => $role,
				'class' => 'form-control',
				'escape' => FALSE
			]);
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