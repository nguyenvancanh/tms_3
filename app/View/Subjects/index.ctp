<h1 class="page-header"><?php echo $pageHeader; ?></h1>
<section class="lead">
	<p><?php echo $this->Session->flash('notify') ?></p>
	<?php
	echo $this->Form->create('Search', [
		'role' => 'form',
		'novalidate' => 'novalidate',
		'inputDefaults' => [
			'format' => ['before', 'between', 'input', 'error', 'after'],
			'div' => ['class' => 'input-group col-sm-8'],
			'error' => ['attributes' => ['wrap' => 'span', 'class' => 'text-danger']]
		],
		'class' => 'form-inline',
		'type' => 'get'
	]);
	echo $this->Form->input('courseId', [
		'options' => $courses,
		'default' => 0,
		'class' => 'form-control',
		'div' => ['class' => 'input-group col-sm-3']
	]);
	$optionsEnd = [
		'label' => __('Search'),
		'class' => 'btn btn-default form-control',
		'div' => false
	];
	echo $this->Form->end($optionsEnd);
	?>
</section>
<div class="row">
	<div class="col-md-12 offset-2">
		<?php echo $this->Session->flash('notify'); ?>
		<?php if (isset($subjects) && !empty($subjects)): ?>
			<?php foreach ($subjects as $subject): ?>
				<div class="panel panel-default" id="<?php echo $subject['UserSubject'][0]['id']; ?>">
					<div class="panel-body">
						<ul class="list-unstyled">
							<p class="label label-danger"><?php echo $courses[$subject['Subject']['course_id']]; ?></p>
							<strong><?php echo $subject['Subject']['name']; ?></strong>
							<p class="text-center text-muted text-info"><?php echo __('Assigned: ') . $subject['Subject']['created']; ?></p>
						</ul>
						<p><?php echo $subject['Subject']['introduction']; ?></p>
						<?php
						if ($subject['UserSubject'][0]['status'] == Subject::STATUS_INPROGRESS):
							echo $this->Html->link(__('Done'), '/subjects/add/' . $subject['UserSubject'][0]['id'] . '/' . $subject['Course']['id'], [
								'escape' => false,
								'class' => 'btn btn-default pull-right',
							]);
						else:
							echo $this->Html->link(__('Completed'), '#'. $subject['UserSubject'][0]['id'], [
								'escape' => false,
								'class' => 'btn btn-success pull-right',
								'title' => __('Completed at ') . $subject['UserSubject'][0]['modified']
							]);	
						endif;
						?>
					</div>
				</div>
			<?php
			endforeach;
			unset($subjects);
			echo $this->element('pagination');
			?>
		<?php else: ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="text-center"><?php echo __('No tasks found!'); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

