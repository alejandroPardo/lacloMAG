<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Crear</span> noticia</h4>
					<span>Escriba su noticia en nuestro editor de texto.</span>
				</div>
				<?php echo $this->Form->create('News', array('action' => 'createNews', 'enctype' => 'multipart/form-data')); ?>
					<p style="margin-left:5%;" >Título de la Noticia (50 caracteres)</p>
					<p>
						<input name="title" type="text" placeholder="Título de la noticia" maxlength="50" value="<?php echo $name;?>" style="width:80%;margin-left:10%;" id="paper" />
					</p>
					<p style="margin-left:5%;" >Resumen de la Noticia (140 caracteres)</p>
					<p>
						<input name="summary" type="text" placeholder="Resumen de la noticia" maxlength="140" value="<?php echo $headline;?>" style="width:80%;margin-left:10%;" id="paper" />
					</p>
					<p style="margin-left:5%;" >Contenido de la Noticia</p>
					<div class="carton container">
						<textarea id="redactor_content" name="content">
							<?php echo $content;?>
						</textarea>
					</div>
					<br>
					<input type="hidden" name="preview" value="<?php echo $preview;?>" />
					<input type="submit" value="Enviar" name="send" class="lime twenty" style="margin-left:5%;" id="btnForm" onClick="return formBtnNews();" />
					<br><br>
				</form>
			</div>
		</div>
	</div>
</div>