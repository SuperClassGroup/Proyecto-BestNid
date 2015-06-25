<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if (isset($_SESSION['id']) && isset($_GET['id'])){
    $producto = $con->getProduct($_GET['id']);
    if ($producto['id_usuario'] == $_SESSION['id']){


        if(isset($_GET['cancelar'])){
            $con->finalizarProducto($producto['id']);
            header('Location: Perfil.php');
            die;
        }

        if(isset($_POST['oferta']) && is_numeric($_POST['oferta'])){
            $con->setGanador($producto['id'],$_POST['oferta']);
            $con->finalizarProducto($producto['id']);
            $venta = $con->getOferta($_POST['oferta']);
            $ganador = $con->getUser($venta['id_usuario']);
        }


?>

<div class="container"><br>
    <?php

    $ofertas = $con->getOfertasOfProduct($producto['id']);

    if(isset($ganador)){?>
        Mail del ganador: 
        <?php echo $ganador['email'] ?>
    <?php }else if(empty($ofertas)){?>
        <li class="divider"></li>
        <p class="center red-text">Esta publicación no tuvo ninguna oferta.</p>
        <li class="divider"></li><br>
        <a href="elegirGanador.php?id=<?php echo $producto['id']; ?>&cancelar" class="btn waves-effect waves-light red lighten-1">Finalizar publicacion</a> <a href="Perfil.php">Cancelar</a>
    <?php }else{ ?>
        <form action="elegirGanador.php?id=<?php echo $producto['id']; ?>" method="POST">
            <ul class="collection">
                <?php foreach ($ofertas as $oferta) {?>
                    <li class="collection-item">
                        <p>
                          <input name="oferta" type="radio" id="oferta<?php echo $oferta['id']?>" selected value="<?php echo $oferta['id']?>" />
                          <label for="oferta<?php echo $oferta['id']?>"><?php echo $oferta['motivo'] ?></label>
                        </p>
                    </li>
                <?php } ?>
            </ul>
            <button type="submit" class="btn waves-effect waves-light red lighten-1">Guardar ganador</button>
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
    <br><img src="img/Error.jpg" width="250" /><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br> 
</div>
<?php
}
}else{
?>
<div class="center">
    <br>
    <h5 class="center red-text"> PAGINA NO DISPONIBLE </h5>
    <br><img src="img/Error.jpg" width="250" /><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br> 
</div>
<?php }

 include('includes/footer.php'); ?>