<div class="section current" id="home">
	<div class="row widgets">
		<div id="pie" class="col sixty">
			<div class="content">
				<div class="heading">
					<h4><span>Historial</span> del Autor</h4>
					<span>Publicaciones, aprovaciones y negaciones</span>
				</div>
				<div class="wrapper padding">
					<div id="pie_chart" style="height: 250px; width: 420px;">
						
						<?php 
							echo "<script>";
							echo "$(document).ready(function(){";
								echo "var data = [{ label: 'Artículos Aprovados: $approved', data: $approved }, { label: 'Artículos Rechazados: $rejected', data: $rejected },{ label: 'Artículos Publicados: $published ', data: $published },{ label: 'Artículos en Edición: $editing ', data: $editing },{ label: 'Artículos sin Enviar: $unsent ', data: $unsent }];";
								echo "$.plot($('#pie_chart'), data,{";	
		       						echo "series: {";
		           						echo "pie: {"; 
		               						echo "show: true";
		         						echo "}";
		      		 				echo "}";
								echo "});";
							echo "});";
							echo "</script>";
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="tasks" class="col fourty last">
			<div class="content">
				<div class="heading">
					<h4><span>Notificaciones</span> recientes</h4>
					<span><a href='#' rel='external'>Últimas notificaciones recibidas</a></span>
				</div>
				<div class="wrapper" style="left: 1px; right: 1px; top: 141px; bottom: 0px;">
					<ul>
						<?php 
							if (empty($notifications)) {
								echo '<li class="layer">';
									echo '<ul>';
										echo '<li>¡No tienes Ninguna Notificación!</li>';
									echo '</ul>';
								echo '</li>';		
							} else {
								foreach ($notifications as $notification):
									echo '<li class="layer">';
										echo '<ul>';
											echo "<li>".$notification['Logbook']['description']."</li>";
										echo '</ul>';
									echo '</li>';	
                				endforeach;
							}
						?>					
					</ul>
				</div>
			</div>
		</div>
	</div>	
</div>