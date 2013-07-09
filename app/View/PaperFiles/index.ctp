<div class="paperFiles index">
	<h2><?php echo __('Paper Files'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('paper_id'); ?></th>
			<th><?php echo $this->Paginator->sort('raw'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($paperFiles as $paperFile): ?>
	<tr>
		<td><?php echo h($paperFile['PaperFile']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paperFile['Paper']['name'], array('controller' => 'papers', 'action' => 'view', $paperFile['Paper']['id'])); ?>
		</td>
		<td><?php echo h($paperFile['PaperFile']['raw']); ?>&nbsp;</td>
		<td><?php echo h($paperFile['PaperFile']['name']); ?>&nbsp;</td>
		<td><?php echo h($paperFile['PaperFile']['type']); ?>&nbsp;</td>
		<td><?php echo h($paperFile['PaperFile']['content']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $paperFile['PaperFile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paperFile['PaperFile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paperFile['PaperFile']['id']), null, __('Are you sure you want to delete # %s?', $paperFile['PaperFile']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Paper File'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Papers'), array('controller' => 'papers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paper'), array('controller' => 'papers', 'action' => 'add')); ?> </li>
	</ul>
</div>
