<h1 class="page-header"><?php echo $pageHeader; ?></h1>
<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<?php
		$labelOptions = ['class' => 'control-label'];
		echo $this->Session->flash('notify');
		echo $this->Form->create(null, [
			'role' => 'form',
			'novalidate' => 'novalidate',
			'inputDefaults' => [
				'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
				'label' => $labelOptions,
				'div' => ['class' => 'form-group'],
				'error' => ['attributes' => ['wrap' => 'span', 'class' => 'text-danger']]
			],
			'type' => 'post'
		]);
		echo $this->Form->input('name', [
			'label' => ['text' => __('Name'), 'class' => $labelOptions],
			'class' => 'form-control',
		]);
		echo $this->Form->input('description', [
			'label' => ['text' => __('Description'), 'class' => $labelOptions],
			'class' => 'form-control',
			'type' => 'textarea'
		]);
		$endOptions = [
			'label' => __('Save Data'),
			'class' => 'btn btn-success',
			'div' => ['class' => 'form-group'],
		];
		echo $this->Form->end($endOptions);
		?>
	</div>
</div>