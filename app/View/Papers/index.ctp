<div class="actions">
  <h3><?php echo __('Actions'); ?></h3>
  <ul>
      <?php echo $this->Form->create('Paper', array('action' => 'createReport')); ?>
      <?php echo $this->Form->input('start_date', array('type' => 'date')); ?>
      <?php echo $this->Form->input('end_date', array('type' => 'date')); ?>
      <?php echo $this->Form->end('Generate Report'); ?>
  </ul>
</div>