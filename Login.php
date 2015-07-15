<?php 

session_start();
include('includes/header.php');
include('includes/modelo.class.php');


if(isset($_REQUEST['user'])){
	$con = new Modelo();
	if( $user = $con->verifyUser($_REQUEST['user'],$_REQUEST['pass'])){
		if ( $user['deleted'] != 1 ){
		$_SESSION['user'] = $_REQUEST['user'];
		$_SESSION['id'] = $user['id'];
		$_SESSION['admin'] = $user['admin'];
		header("Location: index.php");
		}else{
			?><div class="center red-text" ><br> Este usuario fue eliminado </div> <?php
		}
	}
}
?>
<br>
<div class="container center-align">
	<h3 class="red-text">Ingresar</h3>
		<form class="container" action="Login.php" method="post">
			<div class="row">
				<div class="input-field col s12">
				  <input id="first_name" type="text" class="validate" name="user" required />
				  <label for="first_name">Usuario</label>
				</div>
				<div class="input-field col s12">
				  <input id="last_name" type="password" class="validate" name="pass" required />
				  <label for="last_name">Contraseña</label>
				</div>
			</div>
			<div class="row">
				<button class="btn waves-effect waves-light red accent-2" type="submit" name="action">Ingresar
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</form>
		<div class="row">
		<a class="center red-text text-darken-2" href="register.php"> Si todavia no tenes cuenta, haz click aqui para registrarte</a>

		</div>

</div>

<?php include('includes/footer.php'); ?>