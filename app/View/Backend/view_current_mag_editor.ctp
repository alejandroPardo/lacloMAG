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
								<li class=" ">
									<button id="viewArticlesMag" class="white">Ver Articulos Asignados</button>
								</li>
							</ul>
						</li>
						<li class="">
							<ul>
								<li class=" "><button  class="white">No se</button></li>
							</ul>
						</li>
						<li class="">
							<ul>
								<li class=" "><button class="white">Archivar</button></li>
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
	        <?php if (!empty($magazinePapers)): ?>
	        <table  cellpadding="0" cellspacing="0">
	            <tr>
	                    <th>Nombre de Paper</th>
	                    <th>Fecha Creacion</th>
	                    <th>Tipo de Evaluación</th>
	                    <th>Autores</th>
	                    <th class="actions"><?php echo __('Acciones'); ?></th>
	            </tr>
	            <?php foreach ($magazinePapers as $magazinePaper): ?>
	            <tr>
	                <td><?php echo $magazinePaper['Paper']['name']; ?></td>
	                <td><?php echo $magazinePaper['Paper']['created']; ?></td>
	                <td><?php echo $magazinePaper['Paper']['evaluation_type']; ?></td>

	                <td>
	                	<?php foreach ($magazinePaper['Paper']['PaperEvaluator'] as $paperEvaluator): ?>
	                		<p><?php echo $paperEvaluator['Evaluator']['User']['first_name'].' '.$paperEvaluator['Evaluator']['User']['last_name']; ?></p>
	                	<?php endforeach; ?>
	                </td>
	                <td>
                	 	<?php 
		                    echo $this->Html->link(
		                        'Eliminar',
		                    array(
		                        'controller' => 'backend', 
		                        'action' => 'removePaperfromMag',
		                        $magazinePaper['MagazinePaper']['id']),
		                    array( 
		                        'class' => 'removePaper',
		                        'rel' => 'external', 
		                        'escape'=> false)
		                    );
		                ?>
	                </td>
	            </tr>
	             <?php endforeach; ?>
	        </table>
	        <?php else: ?>
	            <p>No hay Evaluadores</p>
	        <?php endif; ?>
    	</div>
</div>
<script type="text/javascript">
    var viewArticlesMag = document.getElementById('viewArticlesMag');
    viewArticlesMag.addEventListener('click', function () {
        $("#modalArticles").modal();
        $('.removePaper').bind("click", function(e) {
            window.location.href = $(this).attr("data-href");
        });
    }, false);

</script>