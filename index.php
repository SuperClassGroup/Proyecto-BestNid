<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();
$categorias = $con->getAllCategories();
$con->update();


if (isset($_REQUEST['order'])){
	$con->setOrder($_REQUEST['order']);
}
if( isset($_REQUEST['categoria']) && is_numeric($_REQUEST['categoria']) ){
	$productos = $con->getProductsOfCategory($_REQUEST['categoria']);
}else{
	$productos = $con->getAllProducts();
}
if (isset($_REQUEST['buscar'])){
	$productos = $con->getAllProductsWith($_REQUEST['buscar']);
}

?>

<div class="row">

	<div class="col s12 m12 l6 center" style="width:auto" >
		<div class="row">
			<div class="col s12 m6 " style="width:auto">
				<a class="dropdown-button btn red lighten-1" href="#" data-activates="drop" style="margin-bottom:5px">Categorias</a>

				<ul id="drop" class="dropdown-content">
					<li><a class="red-text text-darken 1" href="index.php">Todas</a></li>
					<li class="divider"></li>
					<?php foreach( $categorias as $categoria ){ ?>
						<li><a class="red-text text-darken-2" href="index.php?categoria=<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="col s12 m6 " style="width:auto">
			<a class="dropdown-button btn red lighten-1" href="#" data-activates="order" style="margin-bottom:5px">Ordenar</a>

			<ul id="order" class="dropdown-content">
				<li><a class="red-text text-darken 1" href="index.php?<?php if(isset($_REQUEST['categoria'])) echo 'categoria='.$_REQUEST['categoria'].'&'; if(isset($_REQUEST['buscar'])) echo 'buscar='.$_REQUEST['buscar'].'&'; ?>order=fecha_ini DESC">Mas Recientes</a></li>
				<li><a class="red-text text-darken 1" href="index.php?<?php if(isset($_REQUEST['categoria'])) echo 'categoria='.$_REQUEST['categoria'].'&'; if(isset($_REQUEST['buscar'])) echo 'buscar='.$_REQUEST['buscar'].'&'; ?>order=fecha_ini ASC">Mas Antiguos</a></li>
				<li><a class="red-text text-darken 1" href="index.php?<?php if(isset($_REQUEST['categoria'])) echo 'categoria='.$_REQUEST['categoria'].'&'; if(isset($_REQUEST['buscar'])) echo 'buscar='.$_REQUEST['buscar'].'&'; ?>order=titulo">Alfabetico</a></li>
			</ul>
			</div>
		</div>
	</div>
	
	<div class="col s12 m12 l4 right" style="height:36px;line-height:0px">
		<nav style="height:36px;line-height:36px" class="red lighten-1" >
				<form>
					<div class="input-field">
					  <input id="search" placeholder="Buscar" type="search" name="buscar" required>
					  <label style="font-size:1.5rem" for="search"><i class="mdi-action-search red-text text-lighten-5"></i></label>
					  <i class="mdi-navigation-close"></i>
					</div> 
				</form>
		</nav>
	</div>
	
	
	<?php if (isset($_REQUEST['buscar'])){ ?>	
	<div class="col s12" style="height:36px"> <p class="red-text">Mostrando resultados para: <b><?php echo $_REQUEST['buscar']	?> </b>	</p> </div>
	<?php } ?> 
	<?php if (isset($_REQUEST['categoria'])){ ?>	
	<div class="col s12" style="height:36px"> <p class="red-text">Mostrando resultados para la categoria: <b><?php echo $con->getNombreCategoria($_REQUEST['categoria'])?> </b>	</p> </div>
	<?php } ?> 	
	
</div>

<div class="row">
<?php if (empty($productos)){ ?> <p class="col s12 red-text center"> No se encontraron subastas</p> <?php } ?> 
	<?php foreach( $productos as $producto ){ if ($producto['estado'] == 0){ ?>
		<div class="col s12 m6 l4">
		  <div class="card medium">
			<div class="card-image">
			  <img src="<?php echo $producto['foto']; ?>" width="100" class="circle responsive-img" />
			</div>
			<div class="card-content truncate">
				<span class="card-title black-text" class="truncate"><b><?php echo $producto['titulo']; ?></b></span>
				<p class="truncate"><?php echo $producto['descripcion']; ?></p>
				<p class="grey-text truncate" style="font-size:10px">Finaliza en <?php echo $con->DiasRestantes($producto['fecha_fin']); ?> dias</p>
			</div>
			<div class="card-action" style="padding:10px" >
					<a class="red-text left" style="margin-right:0px;margin-left:5px" href="Producto.php?idproducto=<?php echo $producto['id']; ?>">Ver más</a>
					<a class="red-text right" style="margin-right:5px;margin-left:0px" href="Comprar.php?id=<?php echo $producto['id']; ?>">Comprar</a>
			</div>
		  </div>
		</div>
	<?php } } ?>
</div>

<?php include('includes/footer.php'); ?>