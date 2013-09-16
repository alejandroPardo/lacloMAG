<div class="section current">
    <div class="row widgets">
        <div id="pie" class="col full">
            <div class="content">
                <div class="heading">
                    <h4><span>Artículos</span> recibidos</h4>
                    <span>Aquí puede visualizar los artículos recibidos por parte de los autores.</span>
                </div>
                <div id="table" class="tab padding pagTable">
                    <table class="paginationTable" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                                <th>Nombre de Artículo</th>
                                <th>Autor</th>
                                <th><?php echo $this->Paginator->sort('Creado',null, array('rel' => 'external')); ?></th>
                                <th>Revista</th>
                                <th>Status</th>
                                <th>Acciones</th>
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
                            <td><?php echo $paper['Paper']['created']; ?></td>
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
                                    Sin Asignar
                                <?php endif; ?>

                            </td>
                            <?php 
                                echo "<td><strong>";
                                    if($paper['Paper']['status']=="SENT"){echo 'Enviado';} elseif($paper['Paper']['status']=="ASSIGNED"){echo 'Asignado para Revisión';} elseif($paper['Paper']['status']=="REJECTED"){echo 'Rechazado';} elseif($paper['Paper']['status']=="APPROVED"){echo 'Aceptado';}  elseif($paper['Paper']['status']=="UNSENT"){echo 'Por Enviar a Edición';}  elseif($paper['Paper']['status']=="ONREVISION"){echo 'Por Revisar';}  elseif($paper['Paper']['status']=="RECEIVED"){echo 'Recibido en Edición';}  elseif($paper['Paper']['status']=="CONFIRMED"){echo 'Aceptado';}  elseif($paper['Paper']['status']=="PUBLISHED"){echo 'Publicado';}  elseif($paper['Paper']['status']=="UNPUBLISHED"){echo 'No Publicado';}
                                echo "</strong></td>";
                                echo "<td style='text-align: center;'>";
                                        $file = "../paperfiles/view/".$paper['PaperFile']['0']['id'].".pdf";
                                        echo '<a href='.$file.' rel="external" target="_blank" ><span class="glyph download glyph-editor"><span></a>';
                                        /*echo $this->Form->postLink('<span class="glyph delete glyph-editor"></span>', array('action' => 'delete',$paper['Paper']['id']), array('escape'=> false), __('¿Estas seguro de eliminar el artículo %s?', $paper['Paper']['name'])); */?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>