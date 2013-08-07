<table cellpadding="0" cellspacing="0">
    <tr>
            <th>id</th>
            <th>Nombre de paper</th>
            <th>Nombre de Autores</th>
            <th>Creado</th>
            <th>Modificado</th>
            <th>Revista</th>
            <th>Status</th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
    </tr>
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
            <?php foreach ($paper['MagazinePaper'] as $magazinePapers): ?>&nbsp;
                <?php echo h($magazinePapers['Magazine']['name']); ?> </br>
            <?php endforeach; ?>
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