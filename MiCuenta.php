<?php 

$usuario = $con->getUser($_SESSION['id']);

?>

<div class="container">
	<div class="card-panel red lighten-2 white-text">
		<h5><i class="material-icons">person_pin</i> Informacion Personal <a href="#editarDatos"><i class="white-text material-icons right tooltipped" data-position="right" data-delay="30" data-tooltip="Modificar tus datos personales">mode_edit</i></a></h5>
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
		<h5><i class="material-icons">email</i> Informacion de Contacto <a href="#editarDatos"><i class="white-text material-icons right tooltipped" data-position="right" data-delay="30" data-tooltip="Modificar tus datos personales">mode_edit</i></a></h5>
		<li class="divider"></li><br>
		<div class="row">
			<div class="col s12 m6">
			<span><b>Email:</b> <?php echo $usuario['email'];?></span>
			</div>
		</div>
	</div>
	<div class="row center-align valign">
		<div class="col s6 m4">
		<a class="red-text tooltipped" data-position="bottom" data-delay="30" data-tooltip="Modificar tus datos personales" href="#editarDatos"><u>Editar Datos</u></a>
		</div>
		<div class="col s6 m4" >
		<a class="red-text tooltipped" data-position="bottom" data-delay="30" data-tooltip="Modificar unicamente tu contraseña" href="#editarPass"><u>Editar Contraseña</u></a>
		</div>
		<div class="col s12 hide-on-med-and-up">
		<br>
		</div>
		<div class="col s12 m4 valign" >
		<a class="red-text tooltipped modal-trigger" data-position="bottom" data-delay="30" data-tooltip="Eliminar tu cuenta" href="#Eliminar"><u>Eliminar Cuenta</u></a>
		</div>
	</div>
	
	<div id="Eliminar" class="modal">
		<div class="modal-content">
			<h4>Eliminar cuenta </h4>
			<p>¿Estas seguro de eliminar tu cuenta en BestNid? Todavia tenemos mucho que ofrecerte!.<br><br>Si nos dejas, tus subastas activas se cancelaran y tus ofertas se tomaran como invalidas. Ademas no podrás loguearte con este nombre de usuario si te arrepientes y tu progreso se perdera. Esta accion no se puede deshacer<br><br>Tomate tu tiempo. es una decision dificil</p>
		</div>
		<div class="modal-footer">
			<a href="#cancelar" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="eliminarCuenta.php" class="modal-action modal-close waves-effect waves-red btn-flat">Eliminar de todas formas</a>
		</div>
	</div>
	
</div>