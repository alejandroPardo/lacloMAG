<?php echo $this->Form->create('Magazine', array('action' => 'saveCover')); ?>
	<div class="section current">
		<div class="row widgets">
			<div id="pie" class="col full">
				<div class="content">
					<div class="heading">
						<h4><span>Portada</span> de Revista</h4>
						<span>Visualización de la portada de la revista a Publicar.</span>
					</div>
					<div class="section current padding" title="Text" id="text">
						<div class="carton container">
							<div class="column full">
								<div class='cover' style='background: #<?php echo $magazine["color"];?> !important; margin-top:10px; margin-bottom:10px;'>
									<br/>
										<img src='/laclomag/img/cc.png' class='creativecommons'>
									<h3 style="color:#<?php echo $magazine['fontcolor'];?> !important;">
										<?php echo $magazine['edicion'];?>
									</h3>
									<br/>
									<img src="/laclomag/img/bannercover.jpg" alt="logo">
									<h1 style="color:#<?php echo $magazine['fontcolor'];?> !important;">
										<?php echo $magazine['title'];?>
									</h1>
									<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
									<h2 style="color:#<?php echo $magazine['fontcolor'];?> !important;">
										<?php echo $magazine['desc'];?>
									</h2>
									<br/><br/><br/><br/><br/><br/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<br><br>
					<div class="profileData">
						<p>Guardar o Volver</p>
						<p> 
							<input type="hidden" name="magazineid" value="<?php echo $magazine['magazine'];?>"/>
							<input type="hidden" name="color" value="<?php echo $magazine['color'];?>"/>
							<input type="hidden" name="fontColor" value="<?php echo $magazine['fontcolor'];?>"/>
							<input type="hidden" name="title" value="<?php echo $magazine['title'];?>"/>
							<input type="hidden" name="edicion" value="<?php echo $magazine['edicion'];?>"/>
							<input type="hidden" name="desc" value="<?php echo $magazine['desc'];?>"/>
							<input type="submit" value="Guardar" name="send" class="lime twenty" style="margin-left:5%;" id="btnSend"/> 
							<input type="submit" value="Volver" name="send" class="lime twenty" id="btnForm"/>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
