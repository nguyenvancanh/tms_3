<div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 register" >
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title"><?php echo __('Sign Up') ?> </div>
			<div class="signup">
				<?php
					echo $this->Html->link(__('Sign In'), [
						'controller' => 'users',
						'action' => 'login'
					]);
				?>
			</div>
		</div>  
		<div class="panel-body" >
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
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => 'username',
				]);
				echo $this->Form->input('name', [
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => 'fullname'
				]);
				echo $this->Form->input('password', [
					'type' => 'password',
					'class' => 'form-control',
					'placeholder' => 'password'
				]);
				echo $this->Form->input('password_confirm', [
					'type' => 'password',
					'class' => 'form-control',
					'placeholder' => 'password confirm'
				]);
				$submitOptions = [
					'label' => __('Sign up'),
					'div' => ['class' => 'col-md-offset-3 col-md-9'],
					'class' => 'btn btn-lg btn-success'
				];
				echo $this->Form->end($submitOptions);
			?>
		</div>
	</div>
</div>