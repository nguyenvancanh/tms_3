<h1 class="page-header">
	<?php
	echo $pageHeader;
	echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i>&nbsp' . __('Add new course'), ['controller' => 'courses', 'action' => 'add', 'admin' => true], [
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
	'class' => 'form-control ',
	'placeholder' => __('Search course'),
]);
echo $this->Form->end($optionsEnd);
?>
<table class="table table-hover table-responsive" id="table">
	<span  class="pull-right"><?php echo __('Showing page ') . $this->Paginator->counter(); ?></span>
	<thead>
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Last update'); ?></th>
			<th><?php echo __('Action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($courses) && !empty($courses)): ?>
			<?php foreach ($courses as $course): ?>
				<tr>
					<td><?php echo $course['Course']['id']; ?></td>
					<td><?php echo $course['Course']['name']; ?></td>
					<td><?php echo $course['Course']['description']; ?></td>
					<td><?php echo $course['Course']['created']; ?></td>
					<td><?php echo $course['Course']['modified']; ?></td>
					<td>
						<?php
						echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', ['controller' => 'courses', 'action' => 'edit', 'admin' => true, $course['Course']['id']], ['escape' => false, 'class' => 'pad-r-10']);
						echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', ['controller' => 'courses', 'action' => 'delete', 'admin' => true, $course['Course']['id']], [
							'escape' => false], __("Are you sure you want to delete course #{$course['Course']['id']} ?"));
						?>
					</td>
				</tr>
		<?php
			endforeach;
			unset($courses);
		else:
			echo '<tr><td>' . __('No records found !') . '</td></tr>';
		endif;
		?>
	</tbody>
</table>
<ul class="pagination">
	<?php
	echo $this->Paginator->prev(__('Previous'), ['tag' => 'li'], null, ['tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a']);
	echo $this->Paginator->numbers(['separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1]);
	echo $this->Paginator->next(__('Next'), ['tag' => 'li', 'currentClass' => 'disabled'], null, ['tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a']);
	?>
</ul>