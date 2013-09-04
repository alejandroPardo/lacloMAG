<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col seventyfive">
			<div class="content">
				<div class=" col_4  alpha">
					<h4><span>Revista</span> en construcción</h4>
				</div>
				<div class="col_4  omega ">
					<h4><?php echo h($magazine['Magazine']['name']);?></h4>
				</div>
				<?php if (!empty($magazinePapers)): ?>
			        <table  cellpadding="0" cellspacing="0">
			            <tr>
			                    <th>Nombre de Paper</th>
			                    <th>Fecha Creacion</th>
			                    <th>Tipo de Evaluación</th>
			                    <th>Autores</th>
			                    <th>orden</th>
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
			                <td><?php echo $magazinePaper['MagazinePaper']['order']; ?></td>	
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
		            <p>No hay Articulos</p>
		        <?php endif; ?>
		        <div class="col_6 ">
						<?php
						echo $this->Form->create(false, array('controller' => 'backend', 'action' => 'changeActualMag', 'id'=>'changeActualMag'));
						echo $this->Form->input('magId', array('options' => $magazineList, 'empty' => 'Escoja una'));
						?>
					</div>
					<div class="col_6">
						<?php echo $this->Form->end('Cambiar Revista Actual'); ?>
						
					</div>
		        
				
				
			</div>
		</div>
		<div id="tasks" class="col quarter last">
			<div class="content">
				<div class="heading">
					<h4><span>Acciones</span></h4>
				</div>

				<div id="buttons"class="wrapper" style="left: 1px; right: 1px; top: 141px; bottom: 0px;">
					<ul>
						<li class="">
							<ul>
								<li class=" ">
									<button id="viewArticlesMag" class="white">Reordenar Articulos</button>
									
								</li>
							</ul>
						</li>
						<li class="">
							<ul>
								<li class=" "><button  class="white">Vista Previa</button></li>
							</ul>
						</li>
						<li class="">
							<ul>
								<li class=" ">
								<?php 
				                    echo $this->Html->link(
				                        '<button  class="white">Nueva Revista</button>',
				                    array(
				                        'controller' => 'backend', 
				                        'action' => 'newMag'),
				                    array( 
				                        'rel' => 'external', 
				                        'escape'=> false)
				                    );
				                ?>
				                </li>
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
			<?php echo $this->Form->create(false, array('controller' => 'backend', 'action' => 'changeActualMag', 'id'=>'changeActualMag')); ?>
	        <table  cellpadding="0" cellspacing="0">
	            <tr>
	                    <th>Nombre de Paper</th>
	                    <th>orden</th>
	            </tr>
	            <?php foreach ($magazinePapers as $magazinePaper): ?>
	            <tr>
	                <td><?php echo $magazinePaper['Paper']['name']; ?></td>
	                <td><?php echo $this->Form->input('order-'.$magazinePaper['MagazinePaper']['id']); ?></td>
	            </tr>
	             <?php endforeach; ?>
	        </table>
	        <?php echo $this->Form->end('Cambiar Orden'); ?>
        <?php else: ?>
            <p>No hay Articulos</p>
        <?php endif; ?>
	</div>
</div>
<div id="modalMag" style="display:none">
	<div class="container">
		<div class="wrapper">
		 	<div class=" col_6 alpha">
            </div>
            <div class=" col_6 omega">
            </div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var viewArticlesMag = document.getElementById('viewArticlesMag');
    
    viewArticlesMag.addEventListener('click', function () {
        $("#modalArticles").modal();
        //$('.removePaper').unbind();
        $('.removePaper').on("click", function(e) {
            var a = confirm('Remover Paper?');
            if (a) {
            	window.location.href = $(this).attr("data-href");
        	}
        });
        $(".modal").on("click", function(e) {
	    	e.stopPropagation();
		}); 
    }, false);


    var changeMag = document.getElementById('changeMag');
    modalMag.addEventListener('click', function () {
    	var changeActualMagForm = document.getElementById('changeActualMag');
    	
    }, false);

    

</script>