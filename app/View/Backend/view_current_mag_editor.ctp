<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col seventyfive">
			<div class="content">
				<div class=" col_4 heading alpha">
					<h4><span>Revista</span> Actual</h4>
				</div>
				<div class="col_4 heading omega">
					<h4><?php echo h($magazine['Magazine']['name']);?></h4>
				</div>
			</div>
		</div>
		<div id="tasks" class="col quarter last">
			<div class="content">
				<div class="heading">
					<h4><span>Acciones</span></h4>
					<span><a href='lasActivities' rel='external'>Últimas actividades realizadas</a></span>
				</div>
				<div id="buttons"class="wrapper" style="left: 1px; right: 1px; top: 141px; bottom: 0px;">
					<ul>
						<li class="">
							<ul>
								<li class=" "><button id="changeRevision" class="white">Ver Articulos Asignados</button></li>
							</ul>
						</li>
						<li class="">
							<ul>
								<li class=" "><button id="changeRevision" class="white">No se</button></li>
							</ul>
						</li>
						<li class="">
							<ul>
								<li class=" "><button id="changeRevision" class="white">Archivar</button></li>
							</ul>
						</li>							
					</ul>
				</div>
			</div>
		</div>
	</div>	
</div>

<div id="modalArticles" style="display:none">
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