<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Evaluar</span> artículos</h4>
					<span>Aquí aparecen los artículos aceptados por usted, con revisiones pendientes por realizar.</span>
				</div>
				<div id="table" class="tab padding pagTable">
					<table>
						<thead>
							<tr>
								<th>Nombre del Artículo</th>
								<th>Tipo de Revisión</th>
								<th>Autor</th>
								<th style="width: 20px;">Visualizar</th>
								<th style="width: 20px;">Evaluar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$index = 0;
								foreach ($papers as $paper):
								echo '<tr>';
									echo "<td>".$paper['Paper']['name']."</td>";
									if($paper['Paper']['evaluation_type']=='OPEN'){echo "<td><strong>Abierta</strong></td>";}else if($paper['Paper']['evaluation_type']=='BLIND'){echo "<td><strong>Ciega</strong></td>";}else if($paper['Paper']['evaluation_type']=='DOUBLEBLIND'){echo "<td><strong>Doble Ciega</strong></td>";}
									if($paper['Paper']['evaluation_type']=='OPEN'){
										echo "<td>";
											echo $paperAuthors[$index]['Author']['User']['first_name'].' '.$paperAuthors[$index]['Author']['User']['last_name'];
										echo "</td>";
									} else {
										echo "<td>Oculto por tipo de revisión</td>";
									}
									echo "<td style='text-align: center;'>";
										$file = "../paperFiles/view/".$paperFiles[$index]['0']['PaperFile']['id'].".pdf";
										echo '<a href='.$file.' rel="external" target="_blank" ><span class="glyph download glyph-editor"><span></a>';
									echo "</td>";
									echo "<td style='text-align: center;'>";
										$file = "evaluatePaper/".$paperFiles[$index]['0']['PaperFile']['id'];
										echo '<a href='.$file.' rel="external"><span class="glyph check glyph-editor"><span></a>';
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