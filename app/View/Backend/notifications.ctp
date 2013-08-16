<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Notificaciones</span> pendientes</h4>
					<span>Aquí puede visualizar todas sus notificaciones.</span>
				</div>
				<div id="table" class="tab padding">
					<table>
						<thead>
							<tr>
								<th>Descripción</th>
								<th>Creado</th>
								<th>Tipo de Notificación</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($notifications as $notification):
								echo '<tr>';
									echo "<td>".$notification['Logbook']['description']."</td>";
									echo "<td>".$notification['Logbook']['created']."</td>";
									echo "<td><strong>";
											if($notification['Logbook']['type']=="NOTIFICATION"){echo 'Notificación';}
									echo "</strong></td>";
								echo "</tr>";
			                endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>