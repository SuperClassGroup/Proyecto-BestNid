<?php 

session_start();
include('includes/header.php');
include('includes/modelo.class.php');


if(isset($_REQUEST['user'])){
	$con = new Modelo();
	if( $con->verifyUser($_REQUEST['user'],$_REQUEST['pass']) )
		$_SESSION['user'] = $_REQUEST['user'];
	
	header("Location: /");
}
?>

<div class="row">
	<form class="col s12" action="/Login.php" method="post">
	  <div class="row">
		<div class="input-field col s6">
		  <input placeholder="Usuario" id="first_name" type="text" class="validate" name="user" required autofocus/>
		  <label for="first_name">Usuario</label>
		</div>
		<div class="input-field col s6">
		  <input id="last_name" type="password" class="validate" name="pass" />
		  <label for="last_name">Pass</label>
		</div>
	  </div>
	  <input type="submit" value="Ingresar" />
	</form>
</div>

<?php include('includes/footer.php'); ?>