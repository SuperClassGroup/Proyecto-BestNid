<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if (isset($_SESSION['id']) && ($_SESSION['admin'])){
?>

<div class="row">
	<div class="col s12">
	  <ul class="tabs">
		<li class="tab"><a href="#Estadisticas">Estadisticas</a></li>
		<li class="tab"><a href="#Categorias">Categorias</a></li>
	  </ul>
	</div>
	<div id="Estadisticas" class="col s12"><br><?php include('Estadisticas.php'); ?></div>
	<div id="Categorias" class="col s12"><br></div>
</div>
  
<?php
}else{
?>
<div class="center">
	<h3 class="center red-text">ERROR</h3>
	<br><img src="img/Error.jpg" width="250px"></img><br><a class="btn red" href="index.php">PAGINA PRINCIPAL</a><br><br></div> 
</div>
<?php

}
 include('includes/footer.php'); ?>