<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('created');
		echo $this->Form->input('modified');
		echo $this->Form->input('email');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('role', array('options', array('admin' => 'Administrador', 'editor' => 'Editor')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
