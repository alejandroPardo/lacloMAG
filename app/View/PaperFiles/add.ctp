<div class="paperFiles form">
<?php echo $this->Form->create('PaperFile'); ?>
	<fieldset>
		<legend><?php echo __('Add Paper File'); ?></legend>
	<?php
		echo $this->Form->input('paper_id');
		echo $this->Form->input('raw');
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Paper Files'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Papers'), array('controller' => 'papers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper'), array('controller' => 'papers', 'action' => 'add')); ?> </li>
	</ul>
</div>
