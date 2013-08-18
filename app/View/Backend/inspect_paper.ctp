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
        <table  class="noTableConf" id="hola" cellpadding="0" cellspacing="0">
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
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="container">
	<div id="buttons">
	    <div class="col_2 alpha">
		 	<button id="newEvaluator" class="white">Asignar Nuevo Evaluador</button>
	    </div>
	    <div class="col_2 alpha">
		 	<button class="white">Cambiar Status</button>
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
                <td ><?php echo $this->Html->link(__('Agregar'), array(
                    'controller' => 'backend', 
                    'action' => 'addEvaluator', 
                    $evaluator['Evaluator']['id'],
                    $id),
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
</div></div>
<script type="text/javascript">
    var newEvaluator = document.getElementById('newEvaluator');
    newEvaluator.addEventListener('click', function () {
        $("#modalContent").modal();
        $('.addEval').bind("click", function(e) {
            window.location.href = $(this).attr("data-href");
        });
    }, false);
   
</script>