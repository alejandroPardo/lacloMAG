<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Artículos</span> por enviar</h4>
					<span>Aquí puede visualizar sus artículos pendientes por enviar a corrección o los que necesitan correcciones tras ser revisados.</span>
				</div>
				<div id="table" class="tab padding pagTable">
					<table>
						<thead>
							<tr>
								<th>Nombre del Artículo</th>
								<th>Creado</th>
								<th>Status</th>
								<th style="width: 20px">Correcciones</th>
								<th style="width: 20px">Modificar</th>
								<th style="width: 20px">Descargar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$index = 0;
								foreach ($papers as $paper):
								echo '<tr>';
									echo "<td>".$paper['Paper']['name']."</td>";
									echo "<td>".$paper['Paper']['created']."</td>";
									echo "<td><strong>";
											if($paper['Paper']['status']=="SENT"){echo 'Enviado';} elseif($paper['Paper']['status']=="ASSIGNED"){echo 'Asignado para Revisión';} elseif($paper['Paper']['status']=="REJECTED"){echo 'Rechazado';} elseif($paper['Paper']['status']=="APPROVED"){echo 'Aceptado';}elseif($paper['Paper']['status']=="UNSENT"){echo 'Por Enviar a Edición';}elseif($paper['Paper']['status']=="REVIEW"){echo 'Por Realizar Correcciones';}
									echo "</strong></td>";
									echo "<td style='text-align: center;'>";
										echo $evalsTable[$index];
									echo "</td>";
									echo "<td style='text-align: center;'>";
										$file = "createArticle/".$paper['Paper']['id'];
										echo '<a href='.$file.' rel="external"><span class="glyph check glyph-editor"><span></a>';
									echo "</td>";
									echo "<td style='text-align: center;'>";
										$file = "../paperFiles/view/".$paperFiles[$index]['0']['PaperFile']['id'].".pdf";
										echo '<a href='.$file.' rel="external" target="_blank" ><span class="glyph download glyph-editor"><span></a>';
									echo "</td>";
								echo "</tr>";
								$index++;
			                endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){
		$(".evals").on('click', function (e) {

			var contenido = "<?php echo $evals;?>";

			options =  { animation: "flipInX", theme: "dark", content: contenido};
		
			$().modal(options);
		});
	});
</script>