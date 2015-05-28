<?php 

include('includes/modelo.class.php');

session_start();
include('includes/header.php');
$con = new Modelo();

$categorias = $con->getAllCategories();

if( isset($_REQUEST['categoria']) && is_numeric($_REQUEST['categoria']) ){
	$productos = $con->getProductsOfCategory($_REQUEST['categoria']);
}else{
	$productos = $con->getAllProducts();
}

?>

<br />
<br />
<a class="dropdown-button btn" href="#" data-activates="drop">Categorias</a>

<ul id="drop" class="dropdown-content">
	<li><a href="/">Todas</a></li>
	<li class="divider"></li>
	<?php foreach( $categorias as $categoria ){ ?>
		<li><a href="/?categoria=<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></a></li>
	<?php } ?>
</ul>

<br />
<div class="row">
	<?php foreach( $productos as $producto ){ ?>
		<div class="col s12 m4">
		  <div class="card">
			<div class="card-image">
			  <img src="<?php echo $producto['foto']; ?>" class="materialboxed" />
			</div>
			<div class="card-content">
				<h4><?php echo $producto['titulo']; ?></h4>
			  <p><?php echo $producto['descripcion']; ?></p>
			</div>
			<div class="card-action">
			  <a href="/Producto.php?id=<?php echo $producto['id']; ?>">Ver más</a>
			</div>
		  </div>
		</div>
	<?php } ?>
</div>



<?php include('includes/footer.php'); ?>