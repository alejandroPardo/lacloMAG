<?php if ($papers): ?>

    <table class="paginationTable" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th>id</th>
                    <th>name Paper</th>
                    <th>name Author</th>
                    <th>status</th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
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
            <td><?php echo h($paper['Paper']['status']); ?>&nbsp;</td>
            <td class="actions ">
                <?php $paperId = $paper['Paper']['id'];?>
                <a  <?php echo 'href="../backend/inspectPaper/'.$paperId.'"'; ?> rel="external"><span class="glyph write glyph-editor"><span></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php else: ?>
    <div class="content">
        <div class="heading">
            <h1>No hay articulos pendientes</h1>
        </div>    
    </div>
<?php endif; ?>
