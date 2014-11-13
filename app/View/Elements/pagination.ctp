<?php 
	echo $this->Paginator->numbers(); 
	echo $this->Paginator->prev(__('« Previous |'), null, null, array('class' => 'disabled')); 
	echo $this->Paginator->next(__(' Next »'), null, null, array('class' => 'disabled')); 
	echo $this->Paginator->counter(); 
?>