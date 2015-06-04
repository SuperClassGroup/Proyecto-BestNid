<?php 
session_start();
include('includes/header.php');
include('includes/modelo.class.php');

if(isset($_POST['user'])){
	$con = new Modelo();
	echo $con->crearUsuarioNuevo($_POST['first_name'],$_POST['last_name'],$_POST['dni'],$_POST['creditcard'],$_POST['user'],$_POST['email'],$_POST['password']);

}

?>
<br>
  <div class="row">
    <form class="col s12" action="/register.php" method="POST">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" required name="first_name" />
          <label for="first_name">Nombree</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" required name="last_name" />
          <label for="last_name">Apellido</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <input id="user" type="text" class="validate" required name="user" />
          <label for="user">Usuario</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="password" type="password" class="validate" required name="password" />
          <label for="password">Contraseña</label>
        </div>
      </div>
	     <div class="row">
        <div class="input-field col s12 m6 l4">
          <input id="creditcard" type="number" class="validate" required name="creditcard" />
          <label for="creditcard">Tarjeta de Credito</label>
        </div>
        <div class="input-field col s12 m6 l4">
          <input id="dni" type="number" class="validate" required name="dni" />
          <label for="dni">Documento</label>
        </div>
        <div class="input-field col s12 l4">
          <input id="email" type="email" class="validate" required name="email" />
          <label for="email">Email</label>
        </div>
      </div>
	  <div class="row center">
  	  <input class="btn waves-effect waves-light red accent-2" type="submit" name="submit" value="Registrarse" />
	  </div>
	  <span class="red-text text-darken-2">Al registrarme, declaro que soy mayor de edad y acepto los Términos y Condiciones y las Políticas de Privacidad de Bestnid</span>
    </form>
  </div>
</div>
<?php include('includes/footer.php'); ?>
