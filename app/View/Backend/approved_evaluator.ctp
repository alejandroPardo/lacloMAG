<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Aceptar</span> revisiones</h4>
					<span>Aquí aparecen los artículos que le fueron asignados, puede aceptar revisarlos o negar la revisión.</span>
				</div>
				<div id="table" class="tab padding pagTable">
					<table>
						<thead>
							<tr>
								<th>Nombre del Paper</th>
								<th>Autor</th>
								<th>Status</th>
								<th style="width: 20px">Visualizar</th>
								<th style="width: 20px">Aceptar</th>
								<th style="width: 20px">Negar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$index = 0;
								foreach ($papers as $paper):
								echo '<tr>';
									echo "<td>".$paper['Paper']['name']."</td>";
									echo "<td>".$author[$index]['0']['User']['first_name']." ".$author[$index]['0']['User']['last_name']."</td>";
									echo "<td><strong>";
											if($paper['PaperEvaluator']['status']=="ASIGNED"){echo 'Asignado';}
									echo "</strong></td>";
									echo "<td style='text-align: center;'>";
										$file = "../paperfiles/view/".$paperFiles[$index]['0']['PaperFile']['id'].".pdf";
										echo '<a href='.$file.' rel="external" target="_blank" ><span class="glyph download glyph-editor"><span></a>';
									echo "</td>";
									echo "<td style='text-align: center;'>";
										$file = "acceptEvaluator/".$paper['PaperEvaluator']['id'];
										echo '<a href='.$file.' rel="external"><span class="glyph check glyph-editor"><span></a>';
									echo "</td>";
									echo "<td style='text-align: center;'>";
										$file = "denyEvaluator/".$paper['PaperEvaluator']['id'];
										echo '<a href='.$file.' rel="external"><span class="glyph delete glyph-editor"><span></a>';
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