<h1 class="page-header"><?php echo $pageHeader; ?></h1>
<div class="row">
	<div class="col-md-12 offset-2">
		<?php echo $this->Session->flash('notify'); ?>
		<?php if (isset($courses) && !empty($courses)): ?>
			<?php foreach ($courses as $course): ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<h1 class="text-justify"><?php echo $course['Course']['name']; ?></h1>
						<blockquote class="blockquote-reverse">
							<?php
							echo $course['Course']['description'];
							if ($joined):
								$completion = $course['CourseMember'][0]['completion'];
								echo '<footer>' . __('You joined at ') . $course['CourseMember'][0]['created'] . '</footer>';
							endif;
							?>
						</blockquote>
						<?php if ($joined && $course['CourseMember'][0]['status'] == Course::STATUS_STARTED): ?>
							<div>
								<p>
									<strong><?php echo __('Progress') ?></strong>
									<span class="pull-right text-muted"><?php echo $completion . __('% Complete') ?></span>
								</p>
								<div class="progress progress-striped active">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $completion; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $completion . '%' ?>">
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div id="CourseAction">
							<section class="pull-left">
								<?php
								echo '<p class="text-success">' . __('Total members: ') . count($course['CourseMember']) . '</p>';
								echo '<p class="text-justify">' . $this->Html->link(__('See all member of this course'), ['controller' => 'courses', 'action' => 'view', $course['Course']['id']]) . '</p>';
								?>
							</section>
							<section class="pull-right">
								<?php
								if ($joined):
									$redirectUrl = [
										'controller' => 'courses',
										'action' => 'delete',
										'admin' => false,
										$course['CourseMember'][0]['id'],
										$course['Course']['name']
									];
									switch ($course['CourseMember'][0]['status']):
										case Course::STATUS_DEFAULT:
											echo $this->Html->link(__('Start learning'), '/courses/start/' . $course['Course']['id'], [
												'escape' => false,
												'class' => 'btn btn-success pull-left',
											]);
											echo $this->Form->postLink(__('Leave this course'), $redirectUrl, ['class' => 'btn btn-danger'], __("Are you sure you want to leave course {$course['Course']['name']} ?"));
											break;
										case Course::STATUS_FINISHED:
											echo $this->Html->link(__('Completed'), $redirectUrl, [
												'title' => __('View information'),
												'class' => 'btn btn-success pull-left',
													], [__('Completed at ') . $course['CourseMember'][0]['modified'] . __(', do you want to leave this course?')]);
											break;
										case Course::STATUS_STARTED:
											echo $this->Html->link(__('Started'), '/subjects/progress?courseId=' . $course['Course']['id'], [
												'title' => __('View progress'),
												'class' => 'btn btn-info pull-left',
											]);
											break;
									endswitch;
								else:
									echo $this->Html->link(__('Join this course'), ['controller' => 'courses', 'action' => 'add', 'admin' => false, $course['Course']['id']], [
										'escape' => false,
										'class' => 'btn btn-info',
									]);
								endif;
								?>
							</section>
						</div>
					</div>
				</div>
			<?php
			endforeach;
			unset($courses);
			?>
		<?php else: ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="text-center">
						<?php
						if ($joined):
							echo __('You have not participated in any course');
						else:
							echo __('There are no public courses');
						endif;
						?>
					</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>