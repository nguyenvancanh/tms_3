<h1 class="page-header"><?php echo $title; ?></h1>
<section class="lead">
	<?php
	$labelOptions = ['class' => 'control-label col-md-3'];
	echo $this->Form->create(null, [
		'class' => 'form-inline',
		'inputDefaults' => [
			'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
			'div' => ['class' => 'form-group'],
			'label' => $labelOptions,
			'between' => '<div class="col-md-6">',
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
	echo $this->Form->select('course_id', $courses, ['empty' => false,
		'value' => $this->Session->check('selectedCourse') ? $this->Session->read('selectedCourse') : null,
		'class' => 'selectpicker show-tick',
		'label' => 'View', 'multiple title' => 'Choose one of the following...'
	]);
	$submiOptions = array(
		'label' => __('Select'),
		'class' => 'btn btn-success',
		'div' => ['class' => 'form-group pad-left-10']
	);
	echo $this->Form->end($submiOptions);
	?>
</section>
<?php echo $this->Session->flash('notify'); ?>
<?php if (isset($users) && is_array($users) && !empty($users)): ?>
	<table class="table table-hover">
		<tr>
			<th><?php echo __("ID"); ?></th>
			<th><?php echo __("Username"); ?></th>
			<th><?php echo __("Fullname"); ?></th>
			<th><?php echo __('Role'); ?></th>
			<th><?php echo __("Action"); ?></th>
		</tr>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user['User']['id']; ?></td>
				<td><?php echo $user['User']['username']; ?></td>
				<td><?php echo $user['User']['name']; ?></td>
				<td><?php echo $role[$user['User']['is_admin']]; ?></td>
				<td><?php
					echo $this->Html->link(__('View Info'), ['controller' => 'users', 'action' => 'view', $user['User']['id'], 'admin' => true], ['escape' => false, 'class' => 'btn btn-info btn-sm margin-r-10']);
					if (($this->Session->check('selectedCourse'))):
						echo $this->Html->link(__('Add to course'), ['controller' => 'courses', 'action' => 'add', 'user', $user['User']['id'], 'admin' => true], ['escape' => false, 'class' => 'btn btn-success btn-sm']);
					endif;
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php
	else:
		echo __("There are no user avaiables");
	endif;
?>