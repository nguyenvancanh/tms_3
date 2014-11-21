<h1 class="page-header"><?php echo $pageHeader; ?></h1>
<div class="col-md-12">
	<table class="table table-hover">
		<?php
		echo $this->Session->flash('notify');
		if (isset($users) && !empty($users)):
			?>
			<tr>
				<td><?php echo __("ID"); ?></td>
				<td><?php echo __("Name"); ?></td>
				<td><?php echo __("Joined"); ?></td>
				<td><?php echo __("Action"); ?></td>
			</tr>
			<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo $user['User']['id']; ?></td>
					<td><?php echo $user['User']['name']; ?></td>
					<td><?php echo $user['CourseMember'][0]['created']; ?></td>
					<td><?php echo $this->Html->link(__('View Profile'), ['controller' => 'users', 'action' => 'view', $user['User']['id']]); ?></td>
				</tr>
		<?php
			endforeach;
		else:
			echo '<p class="text-center">' . __("This course does not have members") . '</p>';
		endif;
		?>
	</table>
	<?php echo $this->element('pagination'); ?>
</div>