<div class="container">
    <div class="col_4 carton alpha">
	 	<h2>Nombre del Articulo</h2>
        <div class="content"><?php echo $paper['Paper']['name'];?></div>
    </div>
    <div class="col_4 carton ">
	 	<h2>Autores</h2>
     	<?php foreach ($paper['PaperAuthor'] as $paperAuthors): ?>
            <div class="content"><?php echo h($paperAuthors['Author']['User']['first_name'].' '.
            $paperAuthors['Author']['User']['last_name']); ?> </div>
        <?php endforeach; ?>
    </div>
    <div class="col_4 carton omega">
	 	<h2>Fecha de Creación</h2>
        <div class="content"><?php echo $paper['Paper']['created'];?></div>
    </div>
</div>
<div class="container">
    <div class="col_6 carton alpha">
        <h2>Evaluadores</h2>
        <table id="hola" cellpadding="0" cellspacing="0">
    	 	<tr>
                    <th>Nombre de Evaluador</th>
                    <th class="actions">Status</th>
                    <th>Acciones</th>
            </tr>
            <?php foreach ($paper['PaperEvaluator'] as $paperEvaluator): ?>
                <tr>
                    <td>
                        <?php echo h($paperEvaluator['Evaluator']['User']['first_name'].' '. $paperEvaluator['Evaluator']['User']['last_name']); ?>
                    </td>
                    <td>
                        <?php echo h($paperEvaluator['status']); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->postLink('<span class="glyph delete glyph-editor"></span>', array('action' => 'deleteEvaluator', $paperEvaluator['id'],$paperId), array('escape'=> false), __('Esta seguro que quiere Eliminarlo?')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="col_6 carton alpha">
        <h2>Tipo revision</h2>
        <div class="content">
            <div class="col_4 alpha">
                <h2><?php echo $paper['Paper']['evaluation_type'];?></h2>
            </div>
            <div class="col_4 omega">
                <button id="changeRevision" class="white">Cambiar Revision</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
	<div id="buttons">
	    <div class="col_2 alpha">
		 	<button id="newEvaluator" class="white">Asignar Nuevo Evaluador</button>
	    </div>
	    <div class="col_2 alpha">
            <?php 
                echo $this->Form->postLink(
                    '<button class="white">Asignar a Revista</button>',
                array(
                    'controller' => 'backend', 
                    'action' => 'addArticleToMag',
                    $paperId),
                array( 
                    'escape'=> false),
                __('Asignar a Revista?')
                );
            ?>
	    </div>
        <div class="col_2 alpha">
            <button class="white"></button>
        </div>
    </div>
</div>

<div id="modalContent" style="display:none">
    <div class="wrapper">
        <?php if (!empty($evaluators)): ?>
        <table id="hola" cellpadding="0" cellspacing="0">
            <tr>
                    <th>Nombre de Evaluador</th>
                    <th class="actions"><?php echo __('Acciones'); ?></th>
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
</div></div>
<script type="text/javascript">
    var newEvaluator = document.getElementById('newEvaluator');
    newEvaluator.addEventListener('click', function () {
        $("#modalContent").modal();
        $('.addEval').bind("click", function(e) {
            window.location.href = $(this).attr("data-href");
        });
    }, false);

    var changeRevision = document.getElementById('changeRevision');
    changeRevision.addEventListener('click', function () {
        $("#modalRevision").modal();
        $('.changeBtn').bind("click", function(e) {
            window.location.href = $(this).attr("data-href");
        });
    }, false);
</script>