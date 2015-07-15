<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if (isset($_SESSION['id'])){
	$id= $_SESSION['id'];
	$con->deleteUser($id);
?>

<div class="row">
	<div class="col s12 center-align"><br>
		<h4 class="red lighten-2 white-text z-depth-1">Cuenta Eliminada</h4>
		<br>
		<img src="img/sad.gif" width="100px"></img>
		<h5>¡Es una pena que te vayas!</h5>
		<p>Esperamos que hayas disfrutado el servicio de BestNid<br>No dudes en visitarnos de nuevo</p>
		<br>
	</div>
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
session_destroy();
include('includes/footer.php'); ?>