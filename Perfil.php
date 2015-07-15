<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if (isset($_SESSION['id'])){
?>

<div class="row">
	<div class="col s12">
	  <ul class="tabs">
		<li class="tab"><a href="#MiCuenta">Cuenta</a></li>
		<li class="tab"><a href="#MisSubastas">Subastas</a></li>
		<li class="tab"><a href="#MisOfertas">Ofertas</a></li>
	  </ul>
	</div>
	<div id="MiCuenta" class="col s12"><br> <?php include('MiCuenta.php'); ?></div>
	<div id="MisSubastas" class="col s12"><br> <?php include('MisSubastas.php'); ?> </div>
	<div id="MisOfertas" class="col s12"><br> <?php include('MisOfertas.php'); ?> </div>
</div>
  
<?php
}else{
?>
<div class="center">
	<h3 class="center red-text">ERROR</h3>
	<h5 class="center red-text"> DEBES ESTAR LOGEADO PARA VER ESTA PAGINA </h5>
	<br><img src="img/Error.jpg" width="250px"></img><br><a class="btn red" href="index.php">PAGINA PRINCIPAL</a><br><br></div> 
</div>
<?php

}
 include('includes/footer.php'); ?>