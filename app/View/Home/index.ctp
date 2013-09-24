<a id="Home"></a>
<div id="nav">
	<div id="navitems">
		<ul>
			<li><a href="#Home">Inicio</a></li>
			<li><a href="#Media">Ejemplares</a></li>
			<li><a href="#Agenda">Noticias</a></li>
			<li><a href="#Location">LACLO</a></li>
			<li><a href="#Registration">¿Quieres formar parte?</a></li>
		</ul>
	</div>
</div>
<?php 
	if($this->Session->check('Message.flash')){
		echo '<div id="nav2">';
			echo '<p>'.$this->Session->flash().'</p>';
		echo '</div>';
	}
?>
<div class="contentsection" id="header">
	<div class="content">
		<h1><img src="img/logoFrontend.png" alt="LACLO Magazine"/></h1>
		<p class="subtext">Último Ejemplar</p>
		<div id="lineset" class="clearfix">
			<div id="linesleft"></div>
			<?php 
				if(!empty($actual)){?>
					<a href="home/magazine/<?php echo $actual["Magazine"]["id"];?>" target="_blank">
					<div id="dates" style='background:#<?php echo $actual["MagazineFile"]["color"];?>'>
						<span class="month">LACLOmag</span>
						<span class="bignumber"><?php echo $actual["Magazine"]["exemplary"];?></span>
					</div>
				</a>
				<div id="linesright"></div>
			</div>
			<p class="location"><?php echo $actual["MagazineFile"]["name"];?><br><?php echo $actual["MagazineFile"]["edition"];?></p>
				<?php } else { ?>
					<div id="dates">
						<span class="month">LACLOmag</span>
						<span class="bignumber"></span>
					</div>
					<div id="linesright"></div>
			</div>
			<p class="location">Aún no ha sido publicada ninguna revista.</p>

				<?php }
			?>
			
		<p class="intro"></p>
		<p class="arrow"><a href="#Media"><img src="img/arrow.png" alt=""></a></p>
	</div>
</div>
<a id="Media"></a>
<div class="contentsection yellow clearfix s2">
	<div class="content">
		<h2>Ejemplares de LACLO Magazine</h2>
		<p>Aquí se pueden ver todos los ejemplares de LACLO Magazine. Descargalos o visualízalos en línea.<img class="flashing" src="img/stripe.gif" alt=""></p>
		<?php if(!empty($actual)){ ?>
			<div id="actual">
				<div class="videoplayer" style="background:#<?php echo $actual['MagazineFile']['color'];?>;">
					<img alt="project" src="img/oldmags.png">
					<img src="img/logo-archive-actual.png" class="logo"/>
					<a href="magazines/view/<?php echo $actual['Magazine']['id'];?>.pdf" target="_blank">
						<img src="img/dl-frontend.png" class="dlder"/>
					</a>
					<a href="home/magazine/<?php echo $actual["Magazine"]["id"];?>" target="_blank">
						<img src="img/view-frontend.png" class="zoomer"/>
					</a>
				</div>
			</div>
		<?php } else {
			echo '<br/><br/><h2 class="location" style="text-align:center;">Aún no ha sido publicada ninguna revista.</p>';
		} ?>
		<div id="projects" class="clearfix">
			<?php foreach ($magazines as $magazine) { ?>
				<div class="project" style="background:#<?php echo $magazine['MagazineFile']['color'];?>;">
					<img alt="project" src="img/oldmags.png">
					<img src="img/logo-archive.png" class="logo"/>
					<p>Revista xxx</p>
					<a href="magazines/view/<?php echo $magazine['Magazine']['id'];?>.pdf" target="_blank">
						<img src="img/dl-frontend.png" class="dlder" alt="">
					</a>
					<a href="home/magazine/<?php echo $magazine["Magazine"]["id"];?>" target="_blank">
						<img src="img/view-frontend.png" class="zoomer" alt="">
					</a>
				</div>
			<?php }?>
		</div>
	</div>
</div>
<a id="Agenda"></a>
<div class="contentsection clearfix beige">
	<div class="content">
		<div class="sectioninfo relative">
			<h2>Noticias</h2>
			<p>Sección con noticias de todo el mundo de los Objetos de Aprendizaje y las tecnologías educativas. Para que te mantengas al tanto de todo lo que sucede.</p>
		</div>
		<div class="normalcontent">
			<div class="agenda">
				<?php
					$aux=null;
					foreach ($news as $new) {
						if($aux != $new['News']['order']){
							$aux=$new['News']['order'];
							$month = explode(" ", $new['News']['order']);
							echo '<div class="agendaitem">';
								echo '<div class="agendaday">';
									echo '<div class="agendadaydate">';
										echo '<span class="month">'.$month[0].'</span>';
										echo '<span class="bignumber">'.$month[1].'</span>';
										echo '<div class="filter"></div>';
									echo '</div>';
						}
									echo '<div class="session">';
										echo '<a href="home/news/'.$new['News']['id'].'" target="_blank"><h3>'.$new['News']['headline'].'</h3></a>';
										echo '<p>'.$new['News']['summary'].'</p>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<a id="Location"></a>
<div class="contentsection dark clearfix">
	<div class="content">
		<div class="sectioninfo relative">
			<h2>LACLO</h2>
			<p>Somos una comunidad abierta, integrada por personas e instituciones interesadas en la investigación, desarrollo y aplicación de las tecnologías relacionadas con Objetos de Aprendizaje en el sector educativo Latinoamericano.</a></p>
			<p><img src="img/loudspeaker.png" alt=""></p>
		</div>
		<div class="normalcontent">
			<br>
			<h2>Conferencias</h2>
			<div id="people" class="clearfix">
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2013.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2013</span><span class="title">21 al 25 de Octubre</span><span class="title">Valdivia, Chile</span></p>
						</div>
					</div>
				</div>
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2012.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2012</span><span class="title">08 al 12 de Octubre</span><span class="title">Guayaquil, Ecuador</span></p>
						</div>
					</div>
				</div>
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2011.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2011</span><span class="title">11 al 14 de Octubre</span><span class="title">Montevideo, Uruguay</span></p>
						</div>
					</div>
				</div>
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2010.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2010</span><span class="title">27 de Septiembre al 01 de Octubre</span><span class="title">São Paulo, Brasil</span></p>
						</div>
					</div>
				</div>
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2009.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2009</span><span class="title">06 al 10 de Julio</span><span class="title">Mérida y Chichen Itza, Yucatán, Mexico</span></p>
						</div>
					</div>
				</div>
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2008.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2008</span><span class="title">27 al 31 de Octubre</span><span class="title">Aguascalientes, Mexico</span></p>
						</div>
					</div>
				</div>
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2007.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2007</span><span class="title">22 al 25 de Octubre</span><span class="title">Santiago, Chile</span></p>
						</div>
					</div>
				</div>
				<!-- conference -->
				<div class="person" >
					<div class="flipper">
						<div class="front">
							<img class="staff" alt="staff" src="img/laclo2006.jpg">
							<img src="img/flip.png" class="flipicon" alt="">
						</div>
						<div class="back">
					    	<p><span class="name">LACLO2006</span><span class="title">23 al 27 de Octubre</span><span class="title">Guayaquil, Ecuador</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="filter"></div>
</div>
<a id="Registration"></a>
<div class="contentsection clearfix red">
	<div class="content">
		<div class="sectioninfo relative">
			<br>
			<h2>¿Quiéres Formar Parte?</h2>
			<p>Envíanos tus datos y te responderemos lo mas pronto posible para que seas parte de la familia de LACLO Magazine.</p>
		</div>
		<div class="normalcontent">
			<form action="home/process" method="post" accept-charset="utf-8">
				<label>Nombre y Apellido</label>
				<input type="text" name="name" placeholder="Nombre y Apellido" required>
				
				<label>Correo Electrónico</label>
				<input type="email" name="email" placeholder="Correo Electrónico" required>
				
				<label>¿Deseas unirte como Autor o Evaluador?</label>
				<input type="text" name="type" placeholder="Autor // Evaluador" required pattern="Autor|Evaluador|autor|evaluador">

				<p><input class="submit" type="submit" value="Enviar &rarr;"></p>
			</form>
			<div class="sponsors">
				<h3>Páginas de Interés</h3>
				<a href="backend/" target="_blank"><img alt="client" src="img/backend.jpg"></a>
				<a href="http://www.laclo.org" target="_blank"><img alt="client" src="img/laclo.jpg"></a>
				<a href="http://www.ucv.ve" target="_blank"><img alt="client" src="img/ucv.jpg"></a>
				<a href="http://www.laclo.org/index.php?option=com_content&view=article&id=48&Itemid=100058&lang=es" target="_blank"><img alt="client" src="img/repos.jpg"></a>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<div class="footercontent">
		<p>&copy; Copyright LACLOmagazine 2013 - UCV <br>Caracas, Venezuela.</p>
	</div>
</div>