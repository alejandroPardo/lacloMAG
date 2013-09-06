<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Crear</span> noticia</h4>
					<span>Escriba su noticia en nuestro editor de texto.</span>
				</div>
				<?php echo $this->Form->create('News', array('action' => 'createNews', 'enctype' => 'multipart/form-data')); ?>
					<div class="carton container">
						<textarea id="redactor_content" name="content">
							<?php echo $content;?>
						</textarea>
					</div>
					<br>
					<p style="margin-left:5%;" >Nombre del Paper</p>
					<p>
						<input name="name" type="text" placeholder="Nombre del Paper" value="<?php echo $name;?>" style="width:80%;margin-left:10%;" id="paper" />
						<input type="hidden" name="preview" value="<?php echo $preview;?>" />
					</p>
					<input type="submit" value="Enviar" name="send" class="lime twenty" style="margin-left:5%;" id="btnForm" onclick="return formBtn();" /> 
					<input type="submit" value="Guardar Previo" name="send" class="lime twenty" id="btnForm"  onClick="return formBtn();"/>
					<br><br>
				</form>
			</div>
		</div>
	</div>
</div>