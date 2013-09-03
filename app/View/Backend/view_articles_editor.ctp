<table class="paginationTable" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
            <th>Id</th>
            <th>Paper name</th>
            <th>Author ID</th>
            <th><?php echo $this->Paginator->sort('created',null, array('rel' => 'external')); ?></th>
            <th><?php echo $this->Paginator->sort('modified',null, array('rel' => 'external')); ?></th>
            <th>Revista</th>
            <th>Status</th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
    </tr>
    </thead>
    <?php foreach ($papers as $paper): ?>
    <tr>
        <td><?php echo h($paper['Paper']['id']); ?>&nbsp;</td>
        <td><?php echo h($paper['Paper']['name']); ?>&nbsp;</td>
        <td>
            <?php foreach ($paper['PaperAuthor'] as $paperAuthors): ?>&nbsp;
                <?php echo h($paperAuthors['Author']['User']['first_name'].' '.
                $paperAuthors['Author']['User']['last_name']); ?> </br>
            <?php endforeach; ?>
        </td>
        <td><?php echo h($paper['Paper']['created']); ?>&nbsp;</td>
        <td><?php echo h($paper['Paper']['modified']); ?>&nbsp;</td>
        <td>
            <?php if(!empty($paper['MagazinePaper'])): ?>
                <?php foreach ($paper['MagazinePaper'] as $magazinePapers): ?>&nbsp;
                    <?php
                        if($magazinePapers['Magazine']['name'] != ''){
                            echo h($magazinePapers['Magazine']['name']); 
                        } else {
                            echo'Sin Asignar';
                        }
                    ?> 
                 </br>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Sin Asignar</p>
            <?php endif; ?>

        </td>
        <td><?php echo h($paper['Paper']['status']); ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $paper['Paper']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paper['Paper']['id'])); ?>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paper['Paper']['id']), null, __('Are you sure you want to delete # %s?', $paper['Paper']['id'])); ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>