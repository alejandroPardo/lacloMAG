<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Modificar</span> artículo</h4>
					<span>Editor de texto para modificar artículos por el editor.</span>
				</div>
				<?php echo $this->Form->create('Paper', array('action' => 'modifyPaper', 'enctype' => 'multipart/form-data')); ?>
					<div class="carton container">
						<textarea id="redactor_content" name="content">
							<?php echo $content;?>
						</textarea>
					</div>
					<br>
					<h3 style="margin-left:5%;" >Nombre del Artículo: <?php echo $name;?></h3>
					<p>
						<input type="hidden" name="preview" value="<?php echo $preview;?>" />
						<input type="hidden" name="name" value="<?php echo $name;?>" />
					</p>
					<input type="submit" value="Guardar Cambios" name="send" class="lime twenty" style="margin-left:5%;" id="btnForm"/>
					<br><br>
				</form>
			</div>
		</div>
	</div>
</div>