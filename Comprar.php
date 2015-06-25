<?php 
session_start();

include('includes/modelo.class.php');
$con = new Modelo();

$producto = $con->getProduct($_GET['id']);

if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    $mje = "ID invalido";
}else if(!isset($_SESSION['user'])){
    $mje = 'No se puede ofertar sin estar logueado. <a href="Login.php">Ingresar</a>';
}else if( $_SESSION['id'] == $producto['id_usuario'] ){
    $mje = 'No se puede ofertar tu propio producto';
}else if( $con->hasOferta($producto['id']) ){
    $mje = 'Ya ofertaste este producto';
}

if($_POST['idproducto']){
  $con->setOferta( $_SESSION['id'], $_POST['idproducto'], $_POST['precio'], $_POST['necesidad'] );
  $mje = "Tu oferta ha sido enviada.  <a href=\"/\">Volver al inicio</a>";
}

include('includes/header.php');

if(isset($mje)){?>
    <p align="center"><?php echo $mje; ?></p>
<?php }else{ ?>

<br>
<li class="divider"></li>
<div class="center">
    <span class="red-text lighten-2" style="font-size:3rem"> <?php echo $producto['titulo']; ?> </span>
</div>
<li class="divider"></li>
<br>
<div class="row">
    <div class="col s12 m5 l4">
        <img class="materialboxed responsive-img card-panel" width="500" src="<?php echo $producto['foto']; ?>">
    </div>
    <div class="col s12 m7 l8">
        <div class="card-panel">
            <div class="row" >
                <div class="col s12" >
                    <h5 class="red-text lighten-2"> Descripción: </h5>
                    <li class="divider"></li>
                    <p> <?php echo $producto['descripcion']; ?> </p>
                </div>
            </div>
        </div>
        <div class="card-panel z-depth-1">

            <?php if($producto['estado'] != 0 ){ ?>
                <div class="row red-text center">
                    <b><p class="red-text">ESTA SUBASTA HA FINALIZADO</p></b>
                </div>
            <?php }else{ ?>
                <h5 class="red-text lighten-2"> Ofertar: </h5>
                
                <form action="Comprar.php" method="POST">
                  <input type="hidden" name="idproducto" value="<?php echo $producto['id']; ?>" />
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="textarea1" class="materialize-textarea" length="500" name="necesidad" required ></textarea>
                      <label for="textarea1">Tu necesidad</label>
                    </div>
                  
                    <div class="input-field col s1" style="font-size:32px; text-align:right; color: #090">$</div>
                    <div class="input-field col s5">
                      <input id="precio" type="number" class="validate" required name="precio" />
                      <label for="precio">Precio</label>
                    </div>
                    <div class="input-field col s6">
                      <button class="btn waves-effect waves-light green lighten-1" type="submit">Comprar!</button>
                    </div>
                  </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php }

include('includes/footer.php'); ?>