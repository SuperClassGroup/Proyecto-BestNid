<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if (isset($_SESSION['id']) && isset($_GET['id'])){

    $producto = $con->getProduct($_GET['id']);
    
    if(isset($_GET['ok'])){
        $con->cancelarProducto($producto['id']);
        header('Location: Perfil.php');
        die;
    }

    if ($producto['id_usuario'] == $_SESSION['id']){
        ?><div class="container center"><br>
            <li class="divider"></li>
            <h5 class="center red-text">Esta seguro que desea cancelar la subasta?</h5>
            <li class="divider"></li><br><br>
            <a href="cancelarProducto.php?id=<?php echo $producto['id']; ?>&ok" class="btn waves-effect waves-light red lighten-1">SI, cancelar</a> <a class="btn waves-effect waves-light red lighten-1"" href="Perfil.php">No, volver a mi perfil</a>
        </div>
    <?php }else{ ?>
            <div class="center">
                <br>
                <h5 class="center red-text"> PAGINA NO DISPONIBLE </h5>
                <br><img src="img/Error.jpg" width="250px"></img><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br>
            </div>
    <?php }
}else{ ?>
    <div class="center">
        <br>
        <h5 class="center red-text"> PAGINA NO DISPONIBLE </h5>
        <br><img src="img/Error.jpg" width="250px"></img><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br>
    </div>
<?php }

 include('includes/footer.php'); ?>