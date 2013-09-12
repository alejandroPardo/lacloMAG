<?php echo $this->Form->create('Magazine', array('action' => 'saveCover')); ?>
	<div class="section current">
		<div class="row widgets">
			<div id="pie" class="col full">
				<div class="content">
					<div class="heading">
						<h4><span>Revisión</span> de Artículos</h4>
						<span>Aquí puede colocar observaciones o correcciones sobre el artículo a corregir.</span>
					</div>
					<div class="section current padding" title="Text" id="text">
						<div class="carton container border">
							<div class="redactor_box redactor_editor">
								<div class='cover' style='background: #<?php echo $magazine["color"];?> !important;'>
									<br/><br/><br/>
									<?php echo $this->Html->image('bannercover.jpg', array('alt' => 'logo'));?>
									<h1 style="color:#<?php echo $magazine['fontcolor'];?> !important;">
										<?php echo $magazine['title'];?>
									</h1>
									<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
									<h2 style="color:#<?php echo $magazine['fontcolor'];?> !important;">
										<?php echo $magazine['desc'];?>
									</h2>
									<h3 style="color:#<?php echo $magazine['fontcolor'];?> !important;">
										<?php echo $magazine['desc'];?>
									</h3>
								</div/>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<br><br>
					<div class="profileData">
						<p>Enviar o Guardar Evaluación</p>
						<p> 
							<input type="hidden" name="evaluatorid" value=""/>
							<input type="submit" value="Enviar" name="send" class="lime twenty" style="margin-left:5%;" id="btnSend"/> 
							<input type="submit" value="Guardar Previo" name="send" class="lime twenty" id="btnForm"/>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>