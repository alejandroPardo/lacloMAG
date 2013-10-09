<?php echo $this->Form->create('Paper', array('action' => 'saveEvaluation')); ?>
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
							<div id="editor-textarea" class="column">
							</div>
							<div id="editor-preview" class="column right">
								<div class="redactor_box redactor_editor">
									<?php echo $paper; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<br><br>
					<div class="profileData">
						<p>Enviar o Guardar Evaluación</p>
						<p> 
							<input type="hidden" name="evaluatorid" value="<?php echo $evaluatorid;?>"/>
							<input type="submit" value="Enviar" name="send" class="lime twenty" style="margin-left:5%;" id="btnSend"/> 
							<input type="submit" value="Guardar Previo" name="send" class="lime twenty" id="btnForm"/>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$(document).ready(function(){
		$.editor("<?php echo $comment;?>", "#editor-textarea");
		$("form input[type=submit]").click(function() {
		    $("input[type=submit]", $(this).parents("form")).removeAttr("clicked");
		    $(this).attr("clicked", "true");
		});
		$("form").submit(function (e) {
			if($("input[type=submit][clicked=true]").val() == "Enviar"){
				e.preventDefault();
				var options;
				var editor = $('textarea#editor').val();

				editor = editor.replace(new RegExp("/\r\n+|\r+|\n+|\t+/i", "m"), ".s.e.p.");

				var contenido = '<h1>Estado de revisión de Artículo</h1><?php echo $this->Form->create("Paper", array("action" => "saveEvaluation"));?><textarea style="display:none;" name="editor">'+editor+'</textarea><input type="hidden" name="evaluatorid" value="<?php echo $evaluatorid;?>"/><button id="approve" name="selection" value="APPROVED" class="lime full">Aprobar Artículo</button><br/><br/><button id="denied" name="selection" value="DENIED" class="sugar full">Rechazar Artículo</button><br/><br/><button rel="external" id="minorchange" name="selection" value="MINORCHANGE" class="sunlit full">El Editor necesita hacer cambios menores</button><br/><br/><button id="authorchange" name="selection" value="AUTHORCHANGE" class="redconfetti full">El Autor necesita hacer cambios</button></form>';

				options =  { animation: "flipInX", theme: "dark", content: contenido};
			
				$().modal(options);
			}
	    });
	});
</script>
