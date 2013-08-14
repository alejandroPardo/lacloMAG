<div class="container">
    <div class="col_4 carton alpha">
	 	<h2>Nombre del Articulo</h2>
        <div class="content"><?php echo $paper['Paper']['name'];?></div>
    </div>
    <div class="col_4 carton ">
	 	<h2>Autores</h2>
     	<?php foreach ($paper['PaperAuthor'] as $paperAuthors): ?>
            <div class="content"><?php echo h($paperAuthors['Author']['User']['first_name'].' '.
            $paperAuthors['Author']['User']['last_name']); ?> </div>
        <?php endforeach; ?>
    </div>
    <div class="col_4 carton omega">
	 	<h2>Fecha de Creación</h2>
        <div class="content"><?php echo $paper['Paper']['created'];?></div>
    </div>
</div>
<div class="container">
    <div class="col_6 carton alpha">
	 	<h2>Evaluadores</h2>
        <?php foreach ($paper['PaperEvaluator'] as $paperEvaluator): ?>
            <div class="content"><?php echo h($paperEvaluator['Evaluator']['User']['first_name'].' '.
            $paperEvaluator['Evaluator']['User']['last_name']); ?> </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container">
	<div id="buttons">
	    <div class="col_2 alpha">
		 	<button class="white">Asignar Nuevo Evaluador</button>
	    </div>
	    <div class="col_2 alpha">
		 	<button class="white">Cambiar Status</button>
	    </div>
    </div>
</div>

