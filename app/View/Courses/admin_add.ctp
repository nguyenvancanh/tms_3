<h1 class="page-header"><?php echo $pageHeader; ?></h1>
<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<?php
		echo $this->Session->flash('notify');
		$labelOptions = ['class' => 'control-label'];
		echo $this->Form->create(null, [
			'role' => 'form',
			'novalidate' => 'novalidate',
			'inputDefaults' => [
				'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
				'div' => ['class' => 'form-group'],
				'label' => $labelOptions,
				'error' => ['attributes' => ['wrap' => 'span', 'class' => 'text-danger']]
			],
			'type' => 'post'
		]);
		echo $this->Form->input('name', [
			'label' => [
				'class' => $labelOptions,
				'text' => __('Course Name')
			],
			'class' => 'form-control',
		]);
		echo $this->Form->input('description', [
			'label' => [
				'class' => $labelOptions,
				'text' => __('Description')
			],
			'class' => 'form-control',
			'type' => 'textarea'
		]);
		$optionsEnd = [
			'label' => __('Add Courses'),
			'class' => 'btn btn-success',
			'div' => ['class' => 'form-group'],
		];
		echo $this->Form->end($optionsEnd);
		?>
	</div>
</div>
