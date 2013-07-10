<?php echo $this->Form->create('Paper', array('action' => 'uploadPaper')); ?>
<br><br>
<?php echo $this->Form->input('file', array('type' => 'file')); ?>
<?php /*echo $this->Upload->edit('Papers', $user['id']);*/ ?>
<?php echo $this->Form->end('Submit'); ?>