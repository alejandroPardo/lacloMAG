<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Crear</span> artículo</h4>
					<span>Escriba su artículo en nuestro editor de texto.</span>
				</div>
				<?php echo $this->Form->create('Paper', array('action' => 'createPaper', 'enctype' => 'multipart/form-data')); ?>
					<div class="carton container">
						<textarea id="redactor_content" name="content">
							<?php echo $content;?>
						</textarea>
					</div>
					<br>
					<p style="margin-left:5%;" >Nombre del Artículo</p>
					<p>
						<input name="name" type="text" id="paper" placeholder="Nombre del Paper" value="<?php echo $name;?>" style="width:80%;margin-left:10%;" id="video" />
						<input type="hidden" name="userid" value="<?php echo $author;?>" />
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