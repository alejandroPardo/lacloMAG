<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Ver</span> artículos</h4>
					<span>Aquí puede visualizar todos sus artículos creados.</span>
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
											if($paper['Paper']['status']=="UNSENT"){echo 'Por Enviar';} elseif($paper['Paper']['status']=="SENT"){echo 'Enviado';} elseif($paper['Paper']['status']=="ONREVISION"){echo 'Asignado para Revisión';} elseif($paper['Paper']['status']=="REJECTED"){echo 'Rechazado';} elseif($paper['Paper']['status']=="APPROVED"){echo 'Aceptado';} elseif($paper['Paper']['status']=="PUBLISHED"){echo 'Publicado';} elseif($paper['Paper']['status']=="UNPUBLISHED"){echo 'Aceptado';} elseif($paper['Paper']['status']=="REVIEW"){echo 'Por realizar correcciones';}
									echo "</strong></td>";
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