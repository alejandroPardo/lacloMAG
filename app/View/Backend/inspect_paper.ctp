<div class="section current">
    <div class="row widgets">
        <div id="pie" class="col full">
            <div class="content">
                <div class="heading">
                    <h4><span>Detalle de Artículo</span> <?php echo $paper['Paper']['name'];?></h4>
                    <span>Aquí puede agregar los evaluadores al artículo seleccionado y asignarlo a revista en contrucción.</span>
                </div>
                <div class="section current padding" title="Text" id="text">
                    <div class="carton container border">
                        <div id="editor-textarea" class="column">
                            <div class="col_11 carton alpha color sail" style="margin-top:10px;margin-left:25px;">
                                <h2>Nombre del Articulo: <strong><?php echo $paper['Paper']['name'];?></strong></h2>
                                <div class="content">
                                    <?php foreach ($paper['PaperAuthor'] as $paperAuthors): ?>
                                        <h3>Autor: <strong><?php echo $paperAuthors['Author']['User']['first_name'].' '.$paperAuthors['Author']['User']['last_name'];?></strong></h3>
                                        
                                    <?php endforeach; ?>
                                    <h3>Creado: <strong><?php echo $paper['Paper']['created'];?></strong></h3>
                                </div>
                            </div>
                            <div class="col_6 carton alpha color rushhour col_11" style="margin-top:10px;margin-left:25px;">
                                <h2>Tipo revision</h2>
                                <div class="content">
                                    <?php 
                                        if($paper['Paper']['evaluation_type'] == 'OPEN'){ echo '<h2>Abierta</h2><br><h3>Los evaluadores y los autores son conocidos publicamente.</h3>';
                                        } elseif($paper['Paper']['evaluation_type'] == 'BLIND'){ echo '<h2>Ciega</h2><br><h3>No se le da a conocer a los evaluadores el nombre de los autores del artículo.</h3>';
                                        } elseif($paper['Paper']['evaluation_type'] == 'DOUBLEBLIND'){ echo '<h2>Doble Ciega</h2><br><h3>No se le da a conocer a los evaluadores el nombre de los autores del artículo ni a los autores el nombre de los evaluadores.</h3>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col_6 carton alpha col_11" style="margin-top:10px;margin-left:25px;">
                                <table id="hola" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <th>Nombre de Evaluador</th>
                                            <th>Status de Revisión</th>
                                            <th>Acciones</th>
                                    </tr>
                                    <?php foreach ($paper['PaperEvaluator'] as $paperEvaluator): ?>
                                        <tr>
                                            <td>
                                                <?php echo h($paperEvaluator['Evaluator']['User']['first_name'].' '. $paperEvaluator['Evaluator']['User']['last_name']); ?>
                                            </td>
                                            <?php 
                                            echo "<td><strong>";
                                                if($paperEvaluator['status']=="APPROVED"){echo 'Aprobado';} elseif($paperEvaluator['status']=="DENIED"){echo 'Rechazado';} elseif($paperEvaluator['status']=="MINORCHANGE"){echo 'Necesita Cambios Menores';} elseif($paperEvaluator['status']=="AUTHORCHANGE"){echo 'Devuelto al Autor';} elseif($paperEvaluator['status']=="CORRECTED"){echo 'Devuelto al Autor y Corregido';} elseif($paperEvaluator['status']=="ASIGNED"){echo 'Asignado a Evaluador';} elseif($paperEvaluator['status']=="ACCEPT"){echo 'Evaluación Aceptada';} elseif($paperEvaluator['status']=="DENIED"){echo 'Evaluación Rechazada';}
                                            echo "</strong></td>";
                                            ?>
                                            <td style="text-align:center;">
                                                <a id="viewCorrections"><span class="glyph info glyph-editor"></span></a>
                                                <?php echo $this->Form->postLink('<span class="glyph delete glyph-editor"></span>', array('action' => 'deleteEvaluator', $paperEvaluator['id'],$paperEvaluator['evaluator_id'],$paperId), array('escape'=> false), __('Está seguro de que quiere Eliminarlo?')); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                        <div id="editor-preview" class="column right">
                            <div class="redactor_box redactor_editor">
                                <?php echo $paper['PaperFile']['0']['raw'];?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <br><br>
                <div class="profileData">
                    <p>Agregar Evaluadores o Asignar a Revista</p>
                    <p> 
                        <button id="newEvaluator" class="lime twenty" style="margin-left:5%; height:65px;">Asignar o Cambiar Evaluadores</button>
                        <button id="newEvaluator" class="lime twenty" style="height:65px;">Aceptar o Rechazar Artículo</button>
                        <button id="toMagazine" class="lime twenty" style="height:65px;">Asignar a Revista en Construcción</button>
                        <button id="changeRevision" class="lime twenty" style="height:65px;">Cambiar Tipo de Revisión</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalContent" style="display:none">
    <div class="wrapper">
        <?php if (!empty($evaluators)): ?>
        <table>
            <tr>
                    <th>Nombre de Evaluador</th>
                    <th>Acciones</th>
            </tr>
            <?php foreach ($evaluators as $evaluator): ?>
            <tr>
                <td><?php echo $evaluator['User']['first_name'].' '.$evaluator['User']['last_name'] ?></td>
                <td><?php echo $this->Html->link(__('Agregar'), array(
                    'controller' => 'backend', 
                    'action' => 'addEvaluator', 
                    $evaluator['Evaluator']['id'],
                    $paperId),
                    array( 
                        'rel' => 'external', 
                        'class' => 'addEval'
                    ));?>
                </td>
            </tr>
             <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>No hay Evaluadores</p>
        <?php endif; ?>
    </div>
</div>

<div id="modalRevision" style="display:none">
    <div class="container">
        <div id="buttons">
            <div class=" col_4 alpha">
                <?php 
                    echo $this->Html->link(
                        '<button id="" class="white">BLIND</button>',
                    array(
                        'controller' => 'backend', 
                        'action' => 'changeEvaluationType',
                        $paperId,
                        'BLIND'),
                    array( 
                        'class' => 'changeBtn',
                        'rel' => 'external', 
                        'escape'=> false)
                    );
                ?>
            </div>
            <div class=" col_4 alpha">
                <?php 
                    echo $this->Html->link(
                        '<button id="" class="white">OPEN</button>',
                    array(
                        'controller' => 'backend', 
                        'action' => 'changeEvaluationType',
                        $paperId,
                        'OPEN'),
                    array( 
                        'class' => 'changeBtn',
                        'rel' => 'external', 
                        'escape'=> false)
                    );
                ?>
            </div>
            <div class=" col_4 alpha">
                <?php 
                    echo $this->Html->link(
                        '<button id="" class="white">DOUBLEBLIND</button>',
                    array(
                        'controller' => 'backend', 
                        'action' => 'changeEvaluationType',
                        $paperId,
                        'DOUBLEBLIND'),
                    array( 
                        'class' => 'changeBtn',
                        'rel' => 'external', 
                        'escape'=> false)
                    );
                ?>
            </div>
        </div>
    </div>
</div>
<div id="modalCorrections" style="display:none">
    <div class="container">
        aqui van a salir en algun momento las correcciones
    </div>
</div>

</div></div>
<script type="text/javascript">
    var newEvaluator = document.getElementById('newEvaluator');
    newEvaluator.addEventListener('click', function () {
        $("#modalContent").modal();
        $('.addEval').bind("click", function(e) {
            window.location.href = $(this).attr("data-href");
        });
    }, false);

    var viewCorrections = document.getElementById('viewCorrections');
    viewCorrections.addEventListener('click', function () {
        $("#modalCorrections").modal();
    }, false);

    var changeRevision = document.getElementById('changeRevision');
    changeRevision.addEventListener('click', function () {
        $("#modalRevision").modal();
        $('.changeBtn').bind("click", function(e) {
            window.location.href = $(this).attr("data-href");
        });
    }, false);

    var toMagazine = document.getElementById('toMagazine');
    toMagazine.addEventListener('click', function () {
            window.location.href = '../addArticleToMag/<?php echo $paperId;?>';
    }, false);
</script>