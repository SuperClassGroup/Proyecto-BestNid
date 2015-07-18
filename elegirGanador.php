<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();
$ok = false;

if (isset($_SESSION['id']) && isset($_GET['id'])){
    $producto = $con->getProduct($_GET['id']);
    if (($producto['id_usuario'] == $_SESSION['id']) && ($producto['estado'] == 2 )){
		$ok = true;

        if(isset($_GET['cancelar'])){
            $con->finalizarProducto($producto['id']);
            header('Location: Perfil.php');
            die;
        }

        if(isset($_POST['oferta']) && is_numeric($_POST['oferta'])){
            $venta = $con->getOferta($_POST['oferta']);
			$con->setGanador($producto['id'],$venta['id_usuario']);
            $con->finalizarProducto($producto['id']);
            $ganador = $con->getUser($venta['id_usuario']);
			$subastador = $con->getUser($producto['id_usuario']);
			
			$titulo 	= '=?utf-8?B?BestNid: Has Ganado una Subasta!?=';
			$link 		= 'http://bestnid.net46.net/Producto.php?id='. $producto['id'];
			$mensaje	= 'Usted a sido seleccionado como ganador de la subasta: '. $producto['titulo'] ."\n". $link . "\n"; 
			$mensaje   .= "Pongase en contacto con el Subastador: ". $subastador['email'];
			$de 		= 'info.bestnid@gmail.com';
			$dename 	= 'BestNid';
			$para 		= $ganador['email'];

			$cabeceras = 'From: ' . $dename . "<" . $de . ">" . "\r\n";

			mail($para, $titulo, $mensaje, $cabeceras);
        }
	}
}
if ($ok){
?>

<div class="container"><br>
    <?php $ofertas = $con->getOfertasOfProduct($producto['id']);
    if(isset($ganador)){?>
		<div class="center">
			<li class="divider"></li>
			<h4 class="red-text">SUBASTA FINALIZADA!</h4>
			<p class="grey-text">Has elegido al ganador de tu subasta:<br> <?php echo $producto['titulo'] ?> </p> <li class="divider"></li> <br>
			<span class="red-text">MOTIVO DEL GANADOR:</span> <br>
			<?php echo $venta['motivo'] ?><br><br>
			<span class="red-text">EMAIL DEL GANADOR:</span> <br>
			<a class="black-text" href="mailto:<?php echo $ganador['email'] ?>?subject=Ganaste%20mi%20subasta%20en%20BestNid&amp;body=Felicitaciones!%0AHas%20ganado%20mi%20subasta%20en%20Bestnid%0A%0ATe%20contacto%20para%20ponernos%20de%20acuerdo%20en%20la%20forma%20de%20envio">
			<u><?php echo $ganador['email'] ?></u></a><br><br>
			<span class="red-text">MONTO OFRECIDO:</span> <br>
			$<?php echo $venta['monto'] ?><br>
			<span class="red-text">MONTO GANADO:</span> <br>
			$<?php echo ($venta['monto'] * 0.3); ?><br>
			<p class="grey-text">Ya has elegido al ganador, enviale un mail a su correo anunciandole que es el ganador de tu subasta y preguntale como desea que le envies el producto.</p>
			<a class="btn waves-effect waves-light red lighten-1" href="mailto:<?php echo $ganador['email'] ?>?subject=Ganaste%20mi%20subasta%20en%20BestNid&amp;body=Felicitaciones!%0AHas%20ganado%20mi%20subasta%20en%20Bestnid%0A%0ATe%20contacto%20para%20ponernos%20de%20acuerdo%20en%20la%20forma%20de%20envio">
			Enviar Mail</a>
			<br>
			<br>
		</div>
		
		
    <?php }else if(empty($ofertas)){?>
        <li class="divider"></li>
        <p class="center red-text">Esta publicación no tuvo ninguna oferta.</p>
        <li class="divider"></li><br>
		<div class="center">
        <a href="elegirGanador.php?id=<?php echo $producto['id']; ?>&cancelar" class="btn waves-effect waves-light red lighten-1">Finalizar publicacion</a> 
		<a class="btn waves-effect waves-light red lighten-1" href="Perfil.php">Cancelar</a>
		</div>
    <?php }else{ ?>
        <form action="elegirGanador.php?id=<?php echo $producto['id']; ?>" method="POST">
            <li class="divider"></li><div class="center"><h5 class="red-text">ELEGIR GANADOR</h5></div>
			<li class="divider"></li><br>
			<ul class="collection">
				<li class="collection-item center">Seleccione el motivo que mas le guste</li>
                <?php foreach ($ofertas as $oferta) {?>
                    <li class="collection-item">
                        <p>
                          <input name="oferta" type="radio" id="oferta<?php echo $oferta['id']?>" selected value="<?php echo $oferta['id']?>" />
                          <label for="oferta<?php echo $oferta['id']?>"><?php echo $oferta['motivo'] ?></label>
                        </p>
                    </li>
                <?php } ?>
            </ul>
            <div class="center"><button type="submit" class="btn waves-effect waves-light red lighten-1">Guardar ganador</button></div>
        </form>
        <br>
    <?php } ?>
</div>
  
<?php
}else{
?>
<div class="center">
    <br>
    <h5 class="center red-text"> PAGINA NO DISPONIBLE </h5>
    <br><img src="img/Error.jpg" width="250" /><br><a class="btn red" href="index.php">PAGINA PRINCIPAL</a><br><br> 
</div>
<?php
}
include('includes/footer.php');