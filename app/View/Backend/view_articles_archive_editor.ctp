<table class="paginationTable" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
                <th>id</th>
                <th>Nombre Revista</th>
                <th>Fecha Creacion</th>
                <th>Titulo</th>
                <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
    </thead>
    <?php foreach ($magazines as $magazine): ?>
        <tr>
            <td><?php echo h($magazine['Magazine']['id']); ?>&nbsp;</td>
            <td><?php echo h($magazine['Magazine']['name']); ?>&nbsp;</td>
            <td><?php echo h($magazine['Magazine']['created']); ?>&nbsp;</td>
            <td><?php echo h($magazine['Magazine']['title']); ?>&nbsp;</td>
            <td class="actions ">
                <a href="#" class="inspectMag" <?php echo 'data-magid="'.$magazine['Magazine']['id'].'"'; ?> rel="external">Ver Articulos</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php foreach ($magazines as $magazine): ?>
<div <?php echo 'id="paperModal-'.$magazine['Magazine']['id'].'"'; ?>  style="display:none">
    <?php if (!empty($magazine['MagazinePaper'])): ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                        <th>id</th>
                        <th>Nombre Paper</th>
                        <th>Fecha Creacion</th>
                </tr>
            </thead>
            <?php foreach ($magazine['MagazinePaper'] as $magazinePaper): ?>
                <tr>
                    <td> <?php echo $magazinePaper['Paper']['id']; ?></td>
                    <td>  <?php echo $magazinePaper['Paper']['name']; ?></td>
                    <td>  <?php echo $magazinePaper['Paper']['created']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay Articulos</p>
    <?php endif; ?>
</div>
<?php endforeach; ?>

<script type="text/javascript">
    $('.inspectMag').on('click', function () {
        var magId = $(this).get(0).getAttribute('data-magid');
        $("#paperModal-" + magId ).modal();
    });
</script>
