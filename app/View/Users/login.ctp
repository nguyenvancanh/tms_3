<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="form-base">
			<h3 class="text-center text-uppercase"><?php echo $pageHeader ?></h3>
			<?php
			echo $this->Session->flash('notify');
			if (CustomAuthComponent::isLogged() == false):
				$labelOptions = ['class' => 'control-label'];
				echo $this->Form->create(null, [
					'role' => 'form',
					'novalidate' => 'novalidate',
					'inputDefaults' => [
						'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
						'div' => ['class' => 'form-group'],
						'label' => false,
						'error' => ['attributes' => ['wrap' => 'span', 'class' => 'text-danger']],
					],
					'type' => 'post',
					'action' => 'login'
				]);
				echo $this->Form->input('username', [
					'label' => [
						'class' => $labelOptions,
						'text' => __('User Name')
					],
					'class' => 'form-control'
				]);
				echo $this->Form->input('password', [
					'label' => [
						'class' => $labelOptions,
						'text' => __('Password')
					],
					'class' => 'form-control'
				]);
				echo $this->Html->tag('span', __("Don't have an account?&nbsp"));
				echo $this->Html->link(__('Sign up!'), ['controller' => 'users', 'action' => 'add']);
				echo $this->Form->end([
					'label' => __('Login'),
					'class' => 'btn btn-lg btn-info btn-block submit',
					'div' => ['class' => 'form-group']
				]);
			endif;
			?>
		</div>
	</div>
</div>