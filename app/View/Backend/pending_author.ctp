<div class="section padding current">
	<div id="table" class="tab padding">
		<table>
			<thead>
				<tr>
					<th>Nombre del Paper</th>
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
								if($paper['Paper']['status']=="SENT"){echo 'Enviado';} elseif($paper['Paper']['status']=="ASSIGNED"){echo 'Asignado para Revisión';} elseif($paper['Paper']['status']=="REJECTED"){echo 'Rechazado';} elseif($paper['Paper']['status']=="APPROVED"){echo 'Aceptado';}
						echo "</strong></td>";
						echo "<td style='text-align: center;'>";
							$file = "../paperfiles/view/".$paperFiles[$index]['0']['PaperFile']['id'].".pdf";
							echo '<a href='.$file.' rel="external" target="_blank" ><img src="../img/download.png"></a>';
							/*echo $this->Html->link(__('Edit'), array('controller' => 'paperfiles', 'action' => 'view', $paperFiles[$index]['0']['PaperFile']['id'].'.pdf', ), array('target' => '_blank', 'escapeTitle' => false, 'rel' => 'external' ));*/
						echo "</td>";
					echo "</tr>";
					$index++;
                endforeach; ?>
			</tbody>
		</table>
	</div>
</div>