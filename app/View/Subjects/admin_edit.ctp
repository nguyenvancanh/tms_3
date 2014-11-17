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
		echo $this->Form->input('course_id', [
			'label' => [
				'class' => $labelOptions,
				'text' => __('Select courses')
			],
			'type' => 'select',
			'options' => $courses,
			'class' => 'form-control',
		]);
		echo $this->Form->input('name', [
			'label' => [
				'class' => $labelOptions,
				'text' => __('Subject Name')
			],
			'class' => 'form-control',
		]);
		echo $this->Form->input('score', [
			'label' => [
				'class' => $labelOptions,
				'text' => __('Score')
			],
			'class' => 'form-control',
		]);
		echo $this->Form->input('introduction', [
			'label' => [
				'class' => $labelOptions,
				'text' => __('Introduction')
			],
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