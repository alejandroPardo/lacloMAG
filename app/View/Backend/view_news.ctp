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
								<th>Título</th>
								<th>Creado</th>
								<th style="width: 40px">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($news as $new):
								echo '<tr>';
									echo "<td>".$new['News']['headline']."</td>";
									echo "<td>".$new['News']['created']."</td>";
									echo "<td style='text-align: center;'>";
										$file = "createNews/".$new['News']['id'];
										echo '<a href='.$file.' rel="external" ><span class="glyph check glyph-editor"><span></a>';
										$file = "../home/news/".$new['News']['id'];
										echo '<a href='.$file.' rel="external" target="_blank" ><span class="glyph download glyph-editor"><span></a>';
										$file = "../news/delete/".$new['News']['id'];
										echo '<a href='.$file.' rel="external"><span class="glyph delete glyph-editor"><span></a>';
									echo "</td>";
								echo "</tr>";
			                endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>