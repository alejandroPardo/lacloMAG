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
            <a href="#" class="inspectMag" rel="external">Ver Articulos</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<div id="paperModal" style="display:none">
    <p>Hola</p>
</div>

<script type="text/javascript">
    $('.inspectMag').on('click', function () {
        $("#paperModal").modal();
    });
</script>
