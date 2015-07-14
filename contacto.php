<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if (isset($_POST['cuerpo']) && isset($_POST['email'])){
	
	require("includes/phpmailer/class.phpmailer.php");

	$titulo		= "BestNid: " . $_POST['asunto'];
	$mensaje	= "Este mail fue enviado desde BestNid por: \n
Nombre: " . $_POST['nombre'] . ' ' . $_POST['apellido'] . "
Email de contacto: " . $_POST['email'] . "\n
Mensaje: \n". $_POST['cuerpo'];
	$de 		= $_POST['email'];
	$dename 		= $_POST['nombre'];
	
	$mail = new PHPMailer();

    $mail->Username = "info.bestnid@gmail.com"; // your GMail user name
    $mail->Password = "bestnid1234"; 
	
    $mail->AddAddress("info.bestnid@gmail.com"); // recipients email
	$mail->SetFrom($de, $dename);

    $mail->Subject = $titulo;
    $mail->Body    = $mensaje; 

    $mail->Host = "ssl://smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
	
    if(!$mail->Send())
        echo "<p class='red white-text center'>ERROR</p>" . $mail->ErrorInfo;
    else
        echo "<p class='green white-text center'>MENSAJE ENVIADO: Te responderemos en breve</p>";
}

?>
<h4 class="red-text text-lighten-2 center">Contacto</h4>
<p class="grey-text text-darken-1 center-align">Formulario de contacto con BestNid</p><br>
<div class="container">
	<div class="row">
		<form class="col s12" method="post">
			<div class="row">
				<div class="input-field col s6 m4">
					<input placeholder="Juan" id="first_name" type="text" class="validate" required name="nombre">
					<label for="first_name">Nombre</label>
				</div>
				<div class="input-field col s6 m4">
					<input placeholder="Perez" id="last_name" type="text" class="validate" required name="apellido">
					<label for="last_name">Apellido</label>
				</div>
				<div class="input-field col s12 m4">
					<input  placeholder="example@dominio.com" id="email" type="email" class="validate" name="email" required>
					<label for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input  placeholder="Propuesta de Negocio" type="text" class="validate" name="asunto" required>
					<label for="asunto">Asunto</label>
				</div>
				<div class="input-field col s12">
					<textarea placeholder="Cuerpo del mensaje" class="materialize-textarea" id="textarea1" required name="cuerpo"></textarea>
					<label for="textarea1">Mensaje</label>
				</div>
			</div>
			<div class="center-align">
				<button class="btn red accent-2 waves-effect waves-light" type="submit" name="action">Enviar
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</form>
	</div>
</div>
<br>
<?php include('includes/footer.php'); ?>