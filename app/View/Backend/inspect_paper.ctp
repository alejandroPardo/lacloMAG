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
                                        if($paper['Paper']['evaluation_type'] == 'OPEN'){ echo '<strong>Abierta</strong><br>Los evaluadores y los autores son conocidos publicamente.';
                                        } elseif($paper['Paper']['evaluation_type'] == 'BLIND'){ echo '<strong>Ciega</strong><br>No se le da a conocer a los evaluadores el nombre de los autores del artículo.';
                                        } elseif($paper['Paper']['evaluation_type'] == 'DOUBLEBLIND'){ echo '<strong>Doble Ciega</strong><br>No se le da a conocer a los evaluadores el nombre de los autores del artículo ni a los autores el nombre de los evaluadores.';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col_6 carton alpha col_11" style="margin-top:10px;margin-left:25px;">
                                <table id="hola" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <th>Nombre de Evaluador</th>
                                            <th>Tipo de Evaluador</th>
                                            <th>Status de Revisión</th>
                                            <?php if($paper['Paper']['status'] != 'APPROVED'){?>
                                                <th style="width:70px;">Acciones</th>
                                            <?php } ?>
                                    </tr>
                                    <?php foreach ($paper['PaperEvaluator'] as $paperEvaluator): ?>
                                        <tr>
                                            <td>
                                                <?php echo h($paperEvaluator['Evaluator']['User']['first_name'].' '. $paperEvaluator['Evaluator']['User']['last_name']); ?>
                                            </td>
                                            <td>
                                                <?php if($paperEvaluator['type']=="PRINCIPAL"){echo 'Principal';} elseif($paperEvaluator['type']=="SURROGATE"){echo 'Suplente';}?>
                                            </td>
                                            <?php 
                                            echo "<td><strong>";
                                                if($paperEvaluator['status']=="APPROVED"){echo 'Aprobado';} elseif($paperEvaluator['status']=="DENIED"){echo 'Rechazado';} elseif($paperEvaluator['status']=="MINORCHANGE"){echo 'Necesita Cambios Menores';} elseif($paperEvaluator['status']=="AUTHORCHANGE"){echo 'Devuelto al Autor';} elseif($paperEvaluator['status']=="CORRECTED"){echo 'Devuelto al Autor y Corregido';} elseif($paperEvaluator['status']=="ASIGNED"){echo 'Asignado a Evaluador';} elseif($paperEvaluator['status']=="ACCEPT"){echo 'Evaluación Aceptada';} elseif($paperEvaluator['status']=="DENIED"){echo 'Evaluación Rechazada';}
                                            echo "</strong></td>";
                                            ?>
                                            <?php if($paper['Paper']['status'] != 'APPROVED'){?>
                                                <td style="text-align:center;">
                                                    <?php echo $this->Form->postLink('<span class="glyph delete glyph-editor"></span>', array('action' => 'deleteEvaluator', $paperEvaluator['id'],$paperEvaluator['evaluator_id'],$paperId), array('escape'=> false), __('Está seguro de que quiere Eliminarlo?')); ?>
                                                </td>
                                            <?php } ?>
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
                        <?php if($paper['Paper']['status'] == 'APPROVED'){
                            echo '<button id="toMagazine" class="lime twenty" style="height:65px;">Asignar a Revista en Construcción</button>';
                        } else {
                            echo '<button id="acceptArticle" class="lime twenty" style="height:65px;margin-left:5%;">Aceptar o Rechazar Artículo</button>';
                            echo '<button id="changeRevision" class="lime twenty" style="height:65px;">Cambiar Tipo de Revisión</button>';
                            echo '<button id="modifyArticle" class="lime twenty" style="height:65px;">Realizar Cambios al Artículo</button>';
                            if($principalCount<2){
                                echo '<button id="newEvaluator" class="lime twenty" style="height:65px;">Asignar Evaluadores Principales</button>';
                            }
                            if($principalCount==2 && $surrogateCount==0) {
                                echo '<button id="newSurrogate" class="lime twenty" style="height:65px;">Asignar Evaluador Suplente</button>';
                            }
                            if($principalCount==2 && $surrogateCount==1){
                                echo '<button id="viewCorrections" class="lime twenty" style="height:65px;">Visualizar Correcciones Realizadas</button>';
                            }
                        }?>
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
                    <th>Carga Actual</th>
                    <th>Acciones</th>
            </tr>

            <?php $index=0; foreach ($evaluators as $evaluator): ?>
            <tr>
                <td><?php echo $evaluator['User']['first_name'].' '.$evaluator['User']['last_name']; ?></td>
                <td><strong><?php echo $assignedPapers[$index].' Artículos'; ?></strong></td>
                <td><?php echo $this->Html->link('<span class="glyph check glyph-editor"></span>', array(
                    'controller' => 'backend', 
                    'action' => 'addEvaluator', 
                    $evaluator['Evaluator']['id'],
                    $paperId,
                    'PRINCIPAL'),
                    array( 
                        'escape' => false,
                        'rel' => 'external', 
                        'class' => 'addEval'
                    ));
                    $index++;?>
                </td>
            </tr>
             <?php endforeach; ?>
        </table>
        <?php else: ?>
            <h4><span>No hay evaluadores</span> disponibles</h4>
        <?php endif; ?>
    </div>
</div>
<div id="modalSurrogate" style="display:none">
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
                    $paperId,
                    'SURROGATE'),
                    array( 
                        'rel' => 'external', 
                        'class' => 'addEval'
                    ));?>
                </td>
            </tr>
             <?php endforeach; ?>
        </table>
        <?php else: ?>
            <h4><span>No hay evaluadores</span> disponibles</h4>
        <?php endif; ?>
    </div>
</div>

<div id="modalRevision" style="display:none">
    <h1>Cambiar Tipo de Revisión</h1>
    <?php 
        echo $this->Html->link(
            '<button id="" class="lime full">Revisión Ciega</button>',
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
    <br/>
    <br/>
    <?php 
        echo $this->Html->link(
            '<button id="" class="sugar full">Revisión Abierta</button>',
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
    <br/>
    <br/>
    <?php 
        echo $this->Html->link(
            '<button id="" class="sunlit full">Revisión Doble Ciega</button>',
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

<div id="modalCorrections" style="display:none">
    <div class="container">
        <table>
            <tr>
                    <th>Nombre de Evaluador</th>
                    <th>Tipo de Evaluador</th>
                    <th>Status de Revisión</th>
                    <th>Comentarios</th>
            </tr>
            <?php foreach ($paper['PaperEvaluator'] as $paperEvaluator): ?>
                <tr>
                    <td>
                        <?php echo h($paperEvaluator['Evaluator']['User']['first_name'].' '. $paperEvaluator['Evaluator']['User']['last_name']); ?>
                    </td>
                    <td>
                        <?php if($paperEvaluator['type']=="PRINCIPAL"){echo 'Principal';} elseif($paperEvaluator['type']=="SURROGATE"){echo 'Suplente';}?>
                    </td>
                    <?php 
                    echo "<td><strong>";
                        if($paperEvaluator['status']=="APPROVED"){echo 'Aprobado';} elseif($paperEvaluator['status']=="DENIED"){echo 'Rechazado';} elseif($paperEvaluator['status']=="MINORCHANGE"){echo 'Necesita Cambios Menores';} elseif($paperEvaluator['status']=="AUTHORCHANGE"){echo 'Devuelto al Autor';} elseif($paperEvaluator['status']=="CORRECTED"){echo 'Devuelto al Autor y Corregido';} elseif($paperEvaluator['status']=="ASIGNED"){echo 'Asignado a Evaluador';} elseif($paperEvaluator['status']=="ACCEPT"){echo 'Evaluación Aceptada';} elseif($paperEvaluator['status']=="DENIED"){echo 'Evaluación Rechazada';}
                    echo "</strong></td>";
                    ?>
                    <td>
                        <?php if($paperEvaluator['comment']==null){
                            echo 'No hay Correcciones';
                        } else {
                            $cadena = str_replace('.s.e.p.', '<br>', $paperEvaluator['comment']);
                            echo $cadena;
                        }?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div id="acceptReject" style="display:none">
    <h1>Aceptar o Rechazar Artículo</h1>
    <?php 
        echo $this->Html->link(
            '<button id="" class="lime full">Aceptar Artículo</button>',
        array(
            'controller' => 'backend', 
            'action' => 'acceptArticle',
            $paperId,
            'APPROVED'),
        array( 
            'class' => 'changeBtn',
            'rel' => 'external', 
            'escape'=> false)
        );
    ?>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php 
        echo $this->Html->link(
            '<button id="" class="sugar full">Rechazar Artículo</button>',
        array(
            'controller' => 'backend', 
            'action' => 'acceptArticle',
            $paperId,
            'REJECTED'),
        array( 
            'class' => 'changeBtn',
            'rel' => 'external', 
            'escape'=> false)
        );
    ?>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php 
        echo $this->Html->link(
            '<button id="" class="sunlit full">Devolver Artículo al Autor</button>',
        array(
            'controller' => 'backend', 
            'action' => 'acceptArticle',
            $paperId,
            'REVIEW'),
        array( 
            'class' => 'changeBtn',
            'rel' => 'external', 
            'escape'=> false)
        );
    ?>
</div>

<script type="text/javascript">
    
    if ($("#newEvaluator").length > 0){
        var newEvaluator = document.getElementById('newEvaluator');
        newEvaluator.addEventListener('click', function () {
            $('#modalContent').modal({
                animation: "flipInX", 
            });
            $('.addEval').on("click", function(e) {
                var a = confirm('Agregar Evaluador al Artículo?');
                if (a) {
                    window.location.href = $(this).attr("data-href");
                }
            });
            $(".modal").on("click", function(e) {
                e.stopPropagation();
            });

        }, false);
    }

    if ($("#newSurrogate").length > 0){
        var newSurrogate = document.getElementById('newSurrogate');
        newSurrogate.addEventListener('click', function () {
            $('#modalSurrogate').modal({
                animation: "flipInX", 
            });
            $('.addEval').on("click", function(e) {
                var a = confirm('Agregar Evaluador al Artículo?');
                if (a) {
                    window.location.href = $(this).attr("data-href");
                }
            });
            $(".modal").on("click", function(e) {
                e.stopPropagation();
            });

        }, false);
    }

    if ($("#viewCorrections").length > 0){
        var viewCorrections = document.getElementById('viewCorrections');
        viewCorrections.addEventListener('click', function () {
            $("#modalCorrections").modal();
        }, false);
    }

    if ($("#acceptArticle").length > 0){
        var acceptArticle = document.getElementById('acceptArticle');
        acceptArticle.addEventListener('click', function () {
            $("#acceptReject").modal({
                animation: "flipInX", 
                theme: 'dark'
            });
            $('.changeBtn').bind("click", function(e) {
                window.location.href = $(this).attr("data-href");
            });
        }, false);
    }

    if ($("#changeRevision").length > 0){
        var changeRevision = document.getElementById('changeRevision');
        changeRevision.addEventListener('click', function () {
            $('#modalRevision').modal({
                animation: "flipInX",
                theme: "dark" 
            });
            $('.changeBtn').bind("click", function(e) {
                window.location.href = $(this).attr("data-href");
            });
            $(".modal").on("click", function(e) {
                e.stopPropagation();
            });

        }, false);
    }



    if ($("#toMagazine").length > 0){
        var toMagazine = document.getElementById('toMagazine');
        toMagazine.addEventListener('click', function () {
                window.location.href = '../addArticleToMag/<?php echo $paperId;?>';
        }, false);
    }

    if ($("#modifyArticle").length > 0){
        var modifyArticle = document.getElementById('modifyArticle');
        modifyArticle.addEventListener('click', function () {
                window.location.href = '../modifyArticle/<?php echo $paperId;?>';
        }, false);
    }
</script>