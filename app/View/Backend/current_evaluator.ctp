<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Historial</span> del Evaluador</h4>
					<span>Aquí puede visualizar todos sus artículos corregidos.</span>
				</div>
				<div id="table" class="tab padding pagTable">
					<table>
						<thead>
							<tr>
								<th>Nombre del Artículo</th>
								<th>Creado</th>
								<th>Status</th>
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
											if($paper['PaperEvaluator']['status']=="APPROVED"){echo 'Aprobado';} elseif($paper['PaperEvaluator']['status']=="DENIED"){echo 'Rechazado';} elseif($paper['PaperEvaluator']['status']=="MINORCHANGE"){echo 'Necesita Cambios Menores';} elseif($paper['PaperEvaluator']['status']=="AUTHORCHANGE"){echo 'Devuelto al Autor';} elseif($paper['PaperEvaluator']['status']=="CORRECTED"){echo 'Devuelto al Autor y Corregido';}
									echo "</strong></td>";
									echo "<td style='text-align: center;'>";
										$file = "../paperfiles/view/".$paperFiles[$index]['0']['PaperFile']['id'].".pdf";
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