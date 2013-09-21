<div class="section current">
    <div class="row widgets">
        <div id="pie" class="col full">
            <div class="content">
                <div class="heading">
                    <h4><span>Archivo de</span> revistas</h4>
                    <span>Aquí se pueden visualizar las revistas actuales y anteriores de LACLOmagazine.</span>
                </div>
                <div id="table" class="tab padding pagTable">
                    <?php if ($magazines): ?>
                        <table class="paginationTable">
                            <thead>
                                <tr>
                                    <th>Nombre de Revista</th>
                                    <th>Fecha de Creación</th>
                                    <th>Título</th>
                                    <th>Edición</th>
                                    <th style="width:80px; text-align:center;">Acciones</th>
                                </tr>
                            </thead>
                            <?php foreach ($magazines as $magazine): ?>
                                <tr>
                                    <td><?php echo $magazine['Magazine']['name']; ?></td>
                                    <td><?php echo $magazine['Magazine']['created']; ?></td>
                                    <td><?php echo $magazine['MagazineFile']['title']; ?></td>
                                    <td><?php echo $magazine['MagazineFile']['edition']; ?></td>
                                    <td style="width:80px; text-align:center;">
                                        <a href="#" class="inspectMag" <?php echo 'data-magid="'.$magazine['Magazine']['id'].'"'; ?> rel="external"><span class="glyph info glyph-editor"></span></a>
                                        <a href="../magazines/view/<?php echo $magazine['Magazine']['id'];?>.pdf" rel="external" target="_blank"><span class="glyph download glyph-editor"></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <div class="content">
                            <div class="heading">
                                <h1>No hay revistas anteriores.</h1>
                            </div>    
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($magazines as $magazine): ?>
<div <?php echo 'id="paperModal-'.$magazine['Magazine']['id'].'"'; ?>  style="display:none">
    <h1>Artículos en la Revista</h1>
    <?php if (!empty($magazine['MagazinePaper'])): ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre del Artículo</th>
                    <th>Nombre del Autor</th>
                    <th>Fecha de Creación</th>
                </tr>
            </thead>
            <?php foreach ($magazine['MagazinePaper'] as $magazinePaper): ?>
                <tr>
                    <td>  <?php echo $magazinePaper['Paper']['name']; ?></td>
                    <td> <?php echo $magazinePaper['Paper']['PaperAuthor']['0']['Author']['User']['first_name'].' '.$magazinePaper['Paper']['PaperAuthor']['0']['Author']['User']['last_name']; ?></td>
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
