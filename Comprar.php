<?php 
session_start();

include('includes/modelo.class.php');
$con = new Modelo();

if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    $mje = "ID invalido"; $btnpag = 'index.php'; $btnname = 'PAGINA PRINCIPAL';
}else if(!isset($_SESSION['id'])){
    $mje = 'No se puede ofertar sin estar logueado'; $btnpag = 'Login.php'; $btnname = 'INGRESAR';
	}else{
	$producto = $con->getProduct($_GET['id']);
	if( $_SESSION['id'] == $producto['id_usuario'] ){
		$mje = 'No se puede ofertar tu propio producto'; $btnpag = 'index.php'; $btnname = 'PAGINA PRINCIPAL';
	}else if( $con->hasOferta($producto['id']) ){
		$mje = 'Ya ofertaste este producto'; $btnpag = 'index.php'; $btnname = 'PAGINA PRINCIPAL';
		}
	}


if(isset($_POST['idproducto'])){
	if ($_POST['precio']>1){
	$con->setOferta( $_SESSION['id'], $_POST['idproducto'], $_POST['precio'], $_POST['necesidad'] );
	$mje = "Tu oferta ha sido enviada.";  $btnpag = 'Perfil.php'; $btnname = 'IR A MI PERFIL';
	}else{
	$mje = "El monto debe ser mayor a $1";  $btnpag = $_SERVER['HTTP_REFERER']; $btnname = 'Volver';
	}
}

include('includes/header.php');

if(isset($mje)){?>
    <br><div class="red-text center" style="font-size:1.5rem"><?php echo $mje; ?><br><br>
	<?php if($mje != "Tu oferta ha sido enviada."){ ?><img src="img/Error.jpg" width="250" /><br><?php }else{ ?><img src="img/success.jpg" width="250" /><br> <?php } ?>
	<a class="btn red"href="<?php echo $btnpag; ?>"><?php echo $btnname; ?></a>
	<br><br>
	</div>
	
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
                      <label class="grey-text" for="textarea1">Explique por que debe ganar usted la subasta</label>
                    </div>
                  
                    <div class="input-field col s1" style="font-size:32px; text-align:right; color: #090">$</div>
                    <div class="input-field col s5">
                      <input id="precio" type="number" step="0.01" class="validate" required name="precio" />
                      <label for="precio">Monto Ofertado</label>
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