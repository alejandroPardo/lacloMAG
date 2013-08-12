<table cellpadding="0" cellspacing="0">
    <tr>
            <th>id</th>
            <th>name Paper</th>
            <th>name Author</th>
            <th>created</th>
            <th>modified</th>
            <th>status</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($papers as $paper): ?>
    <tr>
        <td><?php echo h($paper['Paper']['id']); ?>&nbsp;</td>
        <td><?php echo h($paper['Paper']['name']); ?>&nbsp;</td>
        <td><?php echo h($paper['Author']['User']['first_name']).' '.h($paper['Author']['User']['last_name']); ?>&nbsp;</td>
        <td><?php echo h($paper['Paper']['created']); ?>&nbsp;</td>
        <td><?php echo h($paper['Paper']['modified']); ?>&nbsp;</td>
        <td><?php echo h($paper['Paper']['status']); ?>&nbsp;</td>
        <td class="actions ">
            <a href="../backend" rel="external"><span class="glyph write glyph-editor"><span></a>
        </td>
    </tr>
<?php endforeach; ?>
</table>