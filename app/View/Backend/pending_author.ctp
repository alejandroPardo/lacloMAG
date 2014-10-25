<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Artículos</span> pendientes</h4>
					<span>Aquí puede visualizar sus artículos pendientes por revisión o las correcciones de los mismos.</span>
				</div>
				<div id="table" class="tab padding pagTable">
					<table>
						<thead>
							<tr>
								<th>Nombre del Artículo</th>
								<th>Creado</th>
								<th>Status</th>
								<!--<th>Evaluadores</th>-->
								<th>Tipo de Revisión</th>
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
											if($paper['Paper']['status']=="SENT"){echo 'Enviado';} elseif($paper['Paper']['status']=="ONREVISION"){echo 'Asignado para Revisión';} elseif($paper['Paper']['status']=="REJECTED"){echo 'Rechazado';} elseif($paper['Paper']['status']=="APPROVED"){echo 'Aceptado';}
									echo "</strong></td>";
									/*echo "<td>";
										if($paper['Paper']['evaluation_type']=='DOUBLEBLIND'){ echo 'Ocultos por tipo de Revisión';} else { 
											$numero=1;
											foreach ($paperEvaluators[$index] as $paperEvaluator) {
												if($paperEvaluator['PaperEvaluator']['type']=='PRINCIPAL'){
													echo 'Principal #'.$numero.': '.$paperEvaluator['Evaluator']['User']['first_name'].' '.$paperEvaluator['Evaluator']['User']['last_name'].'<br>';
													$numero++;
												} else {
													echo 'Suplente: ';
													echo $paperEvaluator['Evaluator']['User']['first_name'].' '.$paperEvaluator['Evaluator']['User']['last_name'];
												}
											}
										}
									echo "</td>";*/
									echo "<td><strong> Doble Ciega";
											/*if($paper['Paper']['status']=="ONREVISION"){ if($paper['Paper']['evaluation_type']=='BLIND'){echo 'Ciega';} elseif($paper['Paper']['evaluation_type']=='DOUBLEBLIND'){ echo 'Doble Ciega';}else{echo 'Abierta';}} else{echo 'Aun no ha sido asignado';*/
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