<?php 

$usuario = $con->getUser($_SESSION['id']);

?>

<div class="container">
	<div class="card-panel red lighten-2 white-text">
		<h5><i class="material-icons">person_pin</i> Informacion Personal <a href="#editarDatos"><i class="white-text material-icons right">mode_edit</i></a></h5>
		<li class="divider"></li><br>
		<div class="row">
			<div class="col s12">
			<span><b>Nombre:</b> <?php echo $usuario['nombre'];?></span>
			<br>
			<span><b>Apellido:</b> <?php echo $usuario['apellido'];?></span>
			</div>
			<div class="col s12">
			<br>
			<span><b>Usuario:</b> <?php echo $usuario['user'];?></span>
			<br>
			<span><b>Contraseña:</b> **** </span>
			</div>
			<div class="col s12 ">
			<br>
			<span><b>Tarjeta de Credito:</b> <?php echo $usuario['tarjeta_credito'];?></span>
			</div>
		</div>
	</div>
	<div class="card-panel red lighten-2 white-text">
		<h5><i class="material-icons">email</i> Informacion de Contacto <a href="#editarDatos"><i class="white-text material-icons right">mode_edit</i></a></h5>
		<li class="divider"></li><br>
		<div class="row">
			<div class="col s12 m6">
			<span><b>Email:</b> <?php echo $usuario['email'];?></span>
			</div>
		</div>
	</div>
</div>