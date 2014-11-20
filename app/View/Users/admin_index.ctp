<h1 class="page-header"><?php echo __('List Users'); ?></h1>
<div class="pull-left form-inline">
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

	echo $this->Form->select('role', $role, ['empty' => false,
		'class' => 'selectpicker show-tick',
		'label' => 'View', 'multiple title' => 'Choose one of the following...'
	]);
	$submiOptions = array(
		'label' => __('View'),
		'class' => 'btn btn-success',
		'div' => ['class' => 'form-group pad-left-10']
	);
	echo $this->Form->end($submiOptions);
	?>
</div>
<div class="pull-right">
	<?php
	echo $this->Form->create(null, [
		'role' => 'form',
		'novalidate' => 'novalidate',
		'inputDefaults' => [
			'format' => ['before', 'between', 'input', 'error', 'after'],
			'div' => ['class' => 'input-group col-sm-8'],
			'error' => ['attributes' => ['wrap' => 'span', 'class' => 'text-danger']]
		],
		'class' => 'form-inline',
		'action' => 'index'
	]);
	$optionsEnd = [
		'label' => __('Search'),
		'class' => 'btn btn-default form-control',
		'div' => false
	];
	echo $this->Form->input('keyword', [
		'class' => 'form-control',
		'placeholder' => __('Search.....'),
	]);
	echo $this->Form->end($optionsEnd);
	?>
</div>
<div class="col-md-12">
	<?php echo $this->Session->flash('notify'); ?>
	<?php if (isset($users) && is_array($users)): ?>
		<table class="table table-hover">
			<p  class="text-center"><?php echo __('Showing page ') . $this->Paginator->counter(); ?></p>
			<tr>
				<td><?php echo __("ID"); ?></td>
				<td><?php echo __("Username"); ?></td>
				<td><?php echo __("Fullname"); ?></td>
				<td><?php echo __("Role"); ?></td>
				<td><?php echo __("Modified"); ?></td>
				<td colspan="2"><?php echo __("Action"); ?></td>
			</tr>
			<?php if (!empty($users)): ?>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo $user['User']['id']; ?></td>
						<td><?php echo $user['User']['username']; ?></td>
						<td><?php echo $user['User']['name']; ?></td>
						<td><?php echo $role[$user['User']['is_admin']]; ?></td>
						<td><?php echo $user['User']['modified']; ?></td>
						<td><?php echo $this->Html->link('<i class="glyphicon glyphicon-search"></i>', ['controller' => 'users', 'action' => 'view', $user['User']['id'], 'admin' => true], ['escape' => false, 'class' => 'pad-r-10']); ?></td>
						<td><?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['controller' => 'users', 'action' => 'edit', $user['User']['id'], 'admin' => true], ['escape' => false, 'class' => 'pad-r-10']); ?></td>
						<td><?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', ['action' => 'delete', $user['User']['id']], ['escape' => false], __('Are you sure you want to delete # %s ?', $user['User']['id'])); ?></td>
					</tr>
			<?php
				endforeach;
			else:
				echo __("User not found");
			endif;
			?>
		</table>
	<?php endif; ?>
	<?php echo $this->element('pagination'); ?>
</div>