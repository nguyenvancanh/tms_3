<div class="row text-center">
	<h1><?= $pageHeader ?></h1>
	<h2 class="text-info"><?= $introduction ?></h2>
	<hr/>
	<?php
	echo $this->Html->link(__('Get started!'), '/register', ['class' => 'btn btn-lg btn-success'])
	?>
</div>
