<?php 
session_start();
include('includes/header.php');
include('includes/modelo.class.php');
?>
<br>
<div class="container">
  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" required>
          <label for="first_name">Nombre</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" required>
          <label for="last_name">Apellido</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <input id="user" type="text" class="validate" required>
          <label for="user">Usuario</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="password" type="password" class="validate" required>
          <label for="password">Contraseña</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12 m6 l4">
          <input id="creditcard" type="number" class="validate" required>
          <label for="creditcard">Tarjeta de Credito</label>
        </div>
        <div class="input-field col s12 m6 l4">
          <input id="dni" type="number" class="validate" required>
          <label for="dni">Documento</label>
        </div>
        <div class="input-field col s12 l4">
          <input id="email" type="email" class="validate" required>
          <label for="email">Email</label>
        </div>
      </div>
	  <div class="row center">
	  <button class="btn waves-effect waves-light red accent-2" type="submit" name="action">Registarse
			<i class="mdi-navigation-arrow-forward"></i>
	  </button>
	  </div>
	  <span class="red-text text-darken-2">Al registrarme, declaro que soy mayor de edad y acepto los Términos y Condiciones y las Políticas de Privacidad de Bestnid</span>
    </form>
  </div>
</div>
<?php include('includes/footer.php'); ?>