<div class="container">
    <h1><?php echo $title; ?></h1>
	<hr>
	<div class="row">
		<div class="col-md-9">
			<?php
			echo $this->Session->flash();
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
			echo $this->Form->input('username', [
				'class' => 'form-control',
				'placeholder' => __('Enter username'),
			]);
			echo $this->Form->input('name', [
				'class' => 'form-control',
				'placeholder' => __('Enter user fullname')
			]);
			echo $this->Form->input('password', [
				'class' => 'form-control',
				'placeholder' => __('Enter user password')
			]);
			echo $this->Form->input('password_confirm', [
				'type' => 'password',
				'class' => 'form-control',
				'placeholder' => __('Enter confirm password')
			]);
			echo $this->Form->input('is_admin', [
				'type' => 'select',
				'options' => $role,
				'class' => 'form-control'
			]);

			$submitOptions = [
				'label' => __('Create'),
				'div' => ['class' => 'col-md-offset-3 col-md-9 '],
				'class' => 'btn btn-lg btn-primary'
			];
			echo $this->Form->end($submitOptions);
			?>
		</div>
	</div>
</div>