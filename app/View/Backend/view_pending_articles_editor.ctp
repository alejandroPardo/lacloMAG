<div class="section current">
    <div class="row widgets">
        <div id="pie" class="col full">
            <div class="content">
                <div class="heading">
                    <h4><span>Artículos</span> pendientes</h4>
                    <span>Aquí se pueden visualizar los artículos recibidos por revisar, aprobar, asignar o rechazar.</span>
                </div>
                <div id="table" class="tab padding pagTable">
                    <?php if ($papers): ?>
                        <table class="paginationTable" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                        <th>Nombre del Artículo</th>
                                        <th>Autor</th>
                                        <th>Status</th>
                                        <th style="width:20px;">Seleccionar</th>
                                </tr>
                            </thead>
                            <?php foreach ($papers as $paper): ?>
                            <tr>
                                <td><?php echo h($paper['Paper']['name']); ?>&nbsp;</td>
                                <td>
                                   <?php foreach ($paper['PaperAuthor'] as $paperAuthors): ?>&nbsp;
                                        <?php echo h($paperAuthors['Author']['User']['first_name'].' '.
                                        $paperAuthors['Author']['User']['last_name']); ?> </br>
                                    <?php endforeach; ?>
                                </td>
                                <?php
                                    echo "<td><strong>";
                                        if($paper['Paper']['status']=="SENT"){echo 'Enviado';} elseif($paper['Paper']['status']=="ASSIGNED"){echo 'Asignado para Revisión';} elseif($paper['Paper']['status']=="REJECTED"){echo 'Rechazado';} elseif($paper['Paper']['status']=="APPROVED"){echo 'Aceptado';}  elseif($paper['Paper']['status']=="UNSENT"){echo 'Por Enviar a Edición';}  elseif($paper['Paper']['status']=="ONREVISION"){echo 'Por Revisar';}  elseif($paper['Paper']['status']=="RECEIVED"){echo 'Recibido en Edición';}  elseif($paper['Paper']['status']=="CONFIRMED"){echo 'Aceptado';}  elseif($paper['Paper']['status']=="PUBLISHED"){echo 'Publicado';}  elseif($paper['Paper']['status']=="UNPUBLISHED"){echo 'No Publicado';}
                                    echo "</strong></td>";?>
                                <td style='text-align: center;'>
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
                </div>
            </div>
        </div>
    </div>
</div>

