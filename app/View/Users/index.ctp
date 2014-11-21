<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-hand-o-right"></i> <?php echo __('Actions'); ?>
			</div>
			<div class="panel-body">
				<?php if (isset($activities) && !empty($activities)): ?>
					<?php foreach ($activities as $activity): ?>
						<p class="text-justify text-warning">
							<?php echo $action[$activity['Activity']['action_id']] . $key[$activity['Activity']['key']] . $activity['Activity']['content']; ?>
							<span class="pull-right label label-default"><?php echo CakeTime::format('F jS, Y h:i A', $activity['Activity']['created']); ?></span>
						</p>
					<?php endforeach; ?>
					<?php echo $this->element('pagination'); ?>
				<?php else: ?>
					<p class="text-info"><?php echo __('No activity yet.'); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bell fa-fw"></i> <?php echo __('Notifications Panel'); ?>
			</div>
			<div class="panel-body">
			</div>
		</div>
	</div>
</div>
