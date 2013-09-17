		<div id="container" class="container">	
			<div class="menu-panel">
				<h3><?php echo $magazine['MagazineFile']['name'];?></h3>
				<h3>Tabla de Contenido</h3>
				<ul id="menu-toc" class="menu-toc">
					<li class="menu-toc-current"><a href="#portada">Portada</a></li>
					<?php foreach ($magazinePapers as $magazinePaper) {
						echo '<li><a href="#'.$magazinePaper['MagazinePaper']['order'].'">'.$magazinePaper['Paper']['name'].'</a></li>';
					}?>
				</ul>
			</div>

			<div class="bb-custom-wrapper">
				<div id="bb-bookblock" class="bb-bookblock">
					<div class="bb-item" id="portada">
						<div class="content">
							<div class="scroller">
								<div class='cover' style='background: #<?php echo $magazine['MagazineFile']['color'];?> !important; width:100%; height:100%; float:right;'>
									<?php echo $magazine['MagazineFile']['file'];?>
								</div>
							</div>
						</div>
					</div>
					<?php foreach ($magazinePapers as $magazinePaper) {?>
						<div class="bb-item" id="item<?php echo $magazinePaper['MagazinePaper']['order'];?>">
							<div class="content">
								<div class="scroller">
									<h2><?php echo $magazinePaper['Paper']['name'];?></h2>
									<div class="redactor_box redactor_editor">
										<?php echo $magazinePaper['Paper']['PaperFile']['0']['raw'];?>
									</div>
									<p><em>From <a href="http://www.gutenberg.org/ebooks/41595" target="_blank">"The Funny Side of Physic"</a> by A. D. Crabtre</em></p>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				
				<nav>
					<span id="bb-nav-prev">&larr;</span>
					<span id="bb-nav-next">&rarr;</span>
				</nav>

				<span id="tblcontents" class="menu-button">Tabla de Contenido</span>

			</div>
				
		</div><!-- /container -->
