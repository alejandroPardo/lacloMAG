<div class="papers form">
<?php echo $this->Form->create('Paper'); ?>
	<fieldset>
		<legend><?php echo __('Add Paper'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Papers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Paper Editors'), array('controller' => 'paper_editors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper Editor'), array('controller' => 'paper_editors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paper Authors'), array('controller' => 'paper_authors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper Author'), array('controller' => 'paper_authors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paper Comments'), array('controller' => 'paper_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper Comment'), array('controller' => 'paper_comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paper Evaluators'), array('controller' => 'paper_evaluators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper Evaluator'), array('controller' => 'paper_evaluators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paper Files'), array('controller' => 'paper_files', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper File'), array('controller' => 'paper_files', 'action' => 'add')); ?> </li>
	</ul>
</div>
