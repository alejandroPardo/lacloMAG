<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col seventyfive">
			<div class="content">
				
				<?php if (isset($magazine)): ?>
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
			    <?php else: ?>
				    <div class="heading">
						<h4>No existe una revista en construcción</h4>
					</div>
		    		<ul style="	list-style-type: none;">
						<li class=" ">
							<div class="wrapper">
								<div class="col_12">
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
				                </div>
				            
		                	</div>
		                </li>
					</ul>

			    <?php endif; ?>
		       <!--  <div class="col_6 ">
						<?php
						/*echo $this->Form->create(false, array('controller' => 'backend', 'action' => 'changeActualMag', 'id'=>'changeActualMag'));
						echo $this->Form->input('magId', array('options' => $magazineList, 'empty' => 'Escoja una'));*/
						?>
					</div>
					<div class="col_6">
						<?php /*echo $this->Form->end('Cambiar Revista Actual');*/ ?>
						
					</div> -->
		        
				
				
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
								<li class=" "><button id="publishMagButton" class="white">Publicar revista</button></li>
							</ul>
						</li>				
						<li class="">
							<ul>
								<li class=" "><button id="coverMagButton" class="white">Crear Portada</button></li>
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
			<?php echo $this->Form->create(false, array('controller' => 'backend', 'action' => 'reorderMagPapers')); ?>
	        <table  cellpadding="0" cellspacing="0">
	            <tr>
	                    <th>Nombre de Paper</th>
	                    <th>orden</th>
	            </tr>
	            <?php foreach ($magazinePapers as $magazinePaper): ?>
	            <tr>
	                <td><?php echo $magazinePaper['Paper']['name']; ?></td>
	                <td><?php echo $this->Form->input($magazinePaper['MagazinePaper']['id'],array()); ?></td>
	            </tr>
	             <?php endforeach; ?>
	        </table>
	        <?php echo $this->Form->end('Cambiar Orden'); ?>
        <?php else: ?>
            <p>No hay Articulos</p>
        <?php endif; ?>
	</div>
</div>
<div id="modalMag" style="display:none;">
	<div class="wrapper">
		<h1>Publicar Revista?</h1>
		<div class="col_12">
			<h3> Una vez que haya publicado, no podrás editar mas la revista </h3>
		</div>
		<form action="/lacloMAG/backend/publishMag" id="PaperSaveEvaluationForm" method="post" accept-charset="utf-8">
			<input type="hidden" name="magId" value=<?php echo '"'.$magazine['Magazine']['id'].'"';?> />
			<button name="magstatus" value="APPROVED" type="submit" class="lime full">Publicar</button><br><br>
		</form>
		<button class="closeModal sugar full">Seguir Editando</button><br><br>
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

    var publishMag = document.getElementById('publishMagButton');
    publishMag.addEventListener('click', function () {
    	$('#modalMag').modal({
    		animation: "flipInX", 
    		theme: "dark"
    	});

    	
		$(".modal").on("click", function(e) {
	    	e.stopPropagation();
		}); 

		$(".closeModal").on("click", function(e) {
	    	$('#modalMag').modal().remove();
		}); 
    	
    }, false);

    var coverMag = document.getElementById('coverMagButton');
    coverMag.addEventListener('click', function () {
    	document.location.href="cover/<?php echo $magazine['Magazine']['id'];?>";
    	
    }, false);

</script>