<ul class="pagination">
	<?php
	echo $this->Paginator->prev(__('Previous'), ['tag' => 'li'], null, ['tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a']);
	echo $this->Paginator->numbers(['separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1]);
	echo $this->Paginator->next(__('Next'), ['tag' => 'li', 'currentClass' => 'disabled'], null, ['tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a']);
	?>
</ul>