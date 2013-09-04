<?php
	echo $this->Form->create('Magazine', array(array('controller' => 'backend', 'action' => 'newMag')));
	echo $this->Form->input('name', array('label' => 'Nombre'));
	echo $this->Form->input('title', array('label' => 'Titulo'));
	echo $this->Form->end('Crear');
?>