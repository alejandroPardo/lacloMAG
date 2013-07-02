<?php echo $this->Form->create('PaperFile', array('type' => 'file'));

	echo $this->Form->input('name'); 
	echo $this->Form->input('file', array('type' => 'file')); 

	echo $this->Form->end(__('Submit'));

?>