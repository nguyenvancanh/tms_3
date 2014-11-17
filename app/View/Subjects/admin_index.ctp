<h1 class="page-header">
	<?php
	echo $pageHeader;
	echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i>&nbsp' . __('Add new subject'), ['controller' => 'subjects', 'action' => 'add', 'admin' => true], [
		'escape' => false,
		'class' => 'btn btn-default btn-success action-url pull-right',
	]);
	?>
</h1>
<p><?php echo $this->Session->flash('notify') ?></p>
<?php
echo $this->Form->create(null, [
	'role' => 'form',
	'novalidate' => 'novalidate',
	'inputDefaults' => [
		'format' => ['before', 'between', 'input', 'error', 'after'],
		'div' => ['class' => 'input-group col-sm-5'],
		'error' => ['attributes' => ['wrap' => 'span', 'class' => 'text-danger']]
	],
	'class' => 'form-inline',
	'action' => 'index'
]);
echo $this->Form->input('course_id', [
	'options' => $courses,
	'default' => 0,
	'class' => 'form-control',
	'div' => ['class' => 'input-group col-sm-3']
]);
echo $this->Form->input('keyword', [
	'class' => 'form-control ',
	'placeholder' => __('Search course'),
]);
$optionsEnd = [
	'label' => __('Search'),
	'class' => 'btn btn-default form-control',
	'div' => false
];
echo $this->Form->end($optionsEnd);
?>
<table class="table table-hover table-responsive" id="table">
	<span  class="pull-right"><?php echo __('Showing page ') . $this->Paginator->counter(); ?></span>
	<thead>
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Course'); ?></th>
			<th><?php echo __('Introduction'); ?></th>
			<th><?php echo __('Score'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Last update'); ?></th>
			<th><?php echo __('Action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($subjects) && !empty($subjects)): ?>
			<?php foreach ($subjects as $subject): ?>
				<tr>
					<td><?php echo $subject['Subject']['id']; ?></td>
					<td><?php echo $subject['Subject']['name']; ?></td>
					<td><?php echo $courses[$subject['Subject']['course_id']]; ?></td>
					<td><?php echo $subject['Subject']['introduction']; ?></td>
					<td><?php echo $subject['Subject']['score']; ?></td>
					<td><?php echo $subject['Subject']['created']; ?></td>
					<td><?php echo $subject['Subject']['modified']; ?></td>
					<td>
						<?php
						echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['controller' => 'subjects', 'action' => 'edit', 'admin' => true, $subject['Subject']['id']], ['escape' => false, 'class' => 'pad-r-10']);
						echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', ['controller' => 'subjects', 'action' => 'delete', 'admin' => true, $subject['Subject']['id']], [
							'escape' => false], __("Are you sure you want to delete subject #{$subject['Subject']['id']} ?"));
						?>
					</td>
				</tr>
		<?php
			endforeach;
			unset($subjects);
		else:
			echo '<tr><td>' . __('No records found !') . '</td></tr>';
		endif;
		?>
	</tbody>
</table>
<?php echo $this->element('pagination'); ?>