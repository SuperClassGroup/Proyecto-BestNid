<?php
session_start();
require("includes/PHPMailer/class.phpmailer.php");
include("includes/modelo.class.php");

$con = new Modelo();

$recover = false;

if(isset($_SESSION['id'])){
    header("Location: index.php");
    die;
}

if(isset($_POST['email'])){
    $user = $con->getUserByEmail($_POST['email']);
    if(!$user){
        $mje = 'El email ingresado no existe';
    }else{
        $link = 'http://bestnid.net46.net/recuperarPassword.php?token='.$user['token'];

        $mail = new PHPMailer();

        $mail->Username = "info.bestnid@gmail.com";
        $mail->Password = "bestnid1234"; 

        $mail->AddAddress($user['email']);
        $mail->SetFrom('info.bestnid@gmail.com','Bestnid');

        $mail->Subject = 'BestNid: Reestablecer Clave';
        $mail->Body    = 'Para reestablecer su clave de acceso por favor ingrese a este enlace: '."\n".$link; 

        $mail->Host = "ssl://smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;

        if($mail->Send()){
            $mje = 'El email ha sido enviado';
        }else{
            $mje = 'El email no pudo ser enviado';
        }
    }
}

if(isset($_GET['token'])){
    $user = $con->getUserByToken($_POST['token']);
    $recover = true;
}

if(isset($_POST['recover'])){
    $recover = true;
    $mje = '';
    if( $_POST['pass'] != $_POST['repeticion'] ){
        $mje .= 'Las nuevas contraseñas no coinciden.' . PHP_EOL;
    }else{
        $user = $con->getUserByToken($_POST['recover']);
        $nuevo = $user;
        $nuevo['pass'] = $_POST['pass'];
        $resp .= $con->actualizarUsuario($user, $nuevo);
        $mje .= 'Su contraseña ha sido actualizada. <a href="Login.php">Ingresar</a>' . PHP_EOL;
    }
}


include('includes/header.php');

?>
<div class="container">
   <div class="row">
      <?php if(isset($mje)){?>
          <p class="center red-text"><?php echo $mje ?></p>
      <?php }else{ echo '<br>';}

      if(!$recover){ ?>
      <form class="col s12" method="post">
        <input type="hidden" name="edit" value="Chupame el pito x2." />
        <div class="card-panel">
          <h5><i class="material-icons">person_pin</i> Reestablecer contraseña</h5>
          <li class="divider"></li><br>
          <p>Para reestablecer su contraseña ingrese su dirección de correo para que le enviemos un enlace de recuperación.</p>
          <div class="row">
            <div class="input-field col s12">
              <input required id="email" type="email" name="email" class="validate" />
              <label for="email">Correo asociado a su cuenta</label>
            </div>
          </div>
          <div class="row">
              <button href="#" class="col s12 btn waves-effect waves-light red lighten-1" type="submit">Recuperar</button>
            </div>
        </div>
    </form>
    <?php }else{ ?>
    <form class="col s12" method="post">
        <input type="hidden" name="recover" value="<?php echo $_GET['token']?>" />
        <div class="card-panel">
          <h5><i class="material-icons">person_pin</i> Reestablecer contraseña</h5>
          <li class="divider"></li><br>
          <p>Ingrese su nueva contraseña.</p>
          <div class="row">
            <div class="input-field col s12">
              <input required id="pass" type="password" name="pass" class="validate" />
              <label for="pass">Su nueva contraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input required id="repeticion" type="password" name="repeticion" class="validate" />
              <label for="repeticion">Repita la nueva contraseña</label>
            </div>
          </div>
          <div class="row">
            <button href="#" class="col s12 btn waves-effect waves-light red lighten-1" type="submit">Guardar</button>
          </div>
        </div>
    </form>
    <?php } ?>
  </div>
</div>
<?php
include('includes/footer.php');