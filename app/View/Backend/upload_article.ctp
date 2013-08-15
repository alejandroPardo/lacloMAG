<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col sixty">
			<div class="content">
				<div class="heading">
					<h4><span>Archivos </span>Subidos</h4>
					<span>Aquí podra visualizar los archivos subidos al sistema.</span>
				</div>
				<div class="wrapper padding">
					<?php echo $this->Upload->view('Upload', $username);?>
				</div>
			</div>
		</div>
		<div id="pie" class="col fourty last">
			<div class="content">
				<div class="heading">
					<h4><span>Subir</span> archivo</h4>
					<span>Suelte sobre el cuadro o busque el archivo a subir.</span>
				</div>
				<div class="wrapper padding">
					<br>
					<a href="uploadArticle" rel="external" class="qq-button">Actualizar Página</a>
					<?php echo $this->Upload->edit('Upload', $username);?>
				</div>
			</div>
		</div>
	</div>	
</div>