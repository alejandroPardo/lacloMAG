<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Revista en Construcción: </span><?php echo $magazine['Magazine']['name'];?></h4>
					<span>Artículos y publicación de próximo ejemplar de LACLOmag</span>
				</div>
				<div class="carton container">
			        <table>
			            <tr>
		                    <th>Nombre de Artículo</th>
		                    <th>Creado</th>
		                    <th>Autor</th>
		                    <th style="width:150px;">Orden en Revista</th>
		                    <th style="width:80px;">Acciones</th>
			            </tr>
			            <?php if($magazineFile == 1){?>
				            <tr>
			                    <td>PORTADA</td>
			                    <td></td>
			                    <td></td>
			                    <td></td>
			                    <td style='text-align: center;'>
			                	 	<?php 
					                    echo $this->Html->link(
					                        '<span class="glyph delete glyph-editor"><span>',
					                    array(
					                        'controller' => 'backend', 
					                        'action' => 'removeCoverfromMag',
					                        $magazine['Magazine']['id']),
					                    array( 
					                        'rel' => 'external', 
					                        'escape'=> false)
					                    );
					                ?>
					                <?php 
					                	$file = "../magazineFiles/view/".$magazine['MagazineFile']['id'].".pdf";
										echo '<a href='.$file.' rel="external" target="_blank" ><span class="glyph download glyph-editor"><span></a>';
					                ?>
				                </td>
				            </tr>
				        <?php } ?>
			            <?php foreach ($magazinePapers as $magazinePaper): ?>
			            <tr>
			                <td><?php echo $magazinePaper['Paper']['name']; ?></td>
			                <td><?php echo $magazinePaper['Paper']['created']; ?></td>
			                <td>
			                	<?php foreach ($magazinePaper['Paper']['PaperAuthor'] as $paperEvaluator): ?>
			                		<p><?php echo $paperEvaluator['Author']['User']['first_name'].' '.$paperEvaluator['Author']['User']['last_name']; ?></p>
			                	<?php endforeach; ?>
			                </td>
			                <td><?php echo $magazinePaper['MagazinePaper']['order']; ?></td>	
			                <td style='text-align: center;'>
		                	 	<?php 
				                    echo $this->Html->link(
				                        '<span class="glyph delete glyph-editor"><span>',
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
				                <?php 
				                	$file = "../paperfiles/view/".$magazinePaper['Paper']['PaperFile']['0']['id'].".pdf";
									echo '<a href='.$file.' rel="external" target="_blank" ><span class="glyph download glyph-editor"><span></a>';
				                ?>
			                </td>
			            </tr>
			             <?php endforeach; ?>
			        </table>
				</div>
					<br>
					<button id="viewArticlesMag" class="sugar twenty" style="height:65px;margin-left:2%;">Reordenar Articulos</button>
					<?php if($magazineFile == 0){?>
						<button id="coverMagButton" class="sugar twenty" style="height:65px;">Crear Portada</button>
						<button id="publishMagButton" class="sugar twenty" style="height:65px; display:none;">Publicar revista</button> 
						<button id="previewMag" class="sugar twenty" style="height:65px; display:none;">Vista Previa</button>
					<?php } else { ?>
						<button id="publishMagButton" class="sugar twenty" style="height:65px;">Publicar revista</button>
						<button id="coverMagButton" class="sugar twenty" style="height:65px; display:none;">Crear Portada</button>
						<button id="previewMag" class="sugar twenty" style="height:65px;">Vista Previa</button>
					<?php } ?>
					<br><br>
				</form>
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
        $('#modalArticles').modal({
    		animation: "flipInX", 
    		theme: "dark"
    	});
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

    var previewMag = document.getElementById('previewMag');
    previewMag.addEventListener('click', function () {
    	window.open("../magazines/view/<?php echo $magazine['Magazine']['id'];?>.pdf", '_blank');
    	//document.location.href="../magazines/view/<?php echo $magazine['Magazine']['id'];?>.pdf";
    	
    }, false);

</script>