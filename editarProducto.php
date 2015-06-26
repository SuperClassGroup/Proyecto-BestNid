<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if (isset($_POST['titulo']) && isset($_POST['descripcion'])){
	if($_POST['ruta'] != ""){
		include('includes/subirImagen.class.php'); 
		$subir = new imgUpldr;
		$subir->init($_FILES['imagen']);
		if($error = $subir->_r == ""){ //SI NO HAY ERRORES CON LA CARGA DE IMAGEN
		$con->updateProductoConFoto($_GET['id'],$_POST['titulo'],$_POST['descripcion'],$_POST['idcategoria'],"fotos/{$subir->_name}");
		header("Location: Producto.php?idproducto={$_GET['id']}");
		}
	}else{
		$con->updateProducto($_GET['id'],$_POST['titulo'],$_POST['descripcion'],$_POST['idcategoria']);
		header("Location: Producto.php?idproducto={$_GET['id']}");
	}
}
$categorias = $con->getAllCategories();

if (isset($_SESSION['id']) && isset($_GET['id'])){
	$producto = $con->getProduct($_GET['id']);
	if ($producto['id_usuario'] == $_SESSION['id']){
?>
<div class="container"><br>
	<li class="divider"></li>
	<h5 class="center red-text">Editar Subasta</h5>
	<li class="divider"></li>
	<div class="row center" >
	  <form class="col s12 " action="#" method="post" enctype="multipart/form-data">
		<div class="row">
		  <div class="input-field col s12">
			<input id="input_text" type="text" length="100" name="titulo" value="<?php echo $producto['titulo'];?>"required >
			<label for="input_text">Titulo</label>
		  </div>
		</div>
		<div class="row">
		  <div class="input-field col s12">
			<input type="text" length="500" name="descripcion" value="<?php echo $producto['descripcion'];?>" required ></input>
			<label for="textarea1">Descripcion</label>
		  </div>
		</div>
		<div class="row">
			<div class="col m12 l6">
				<div class="file-field">
				  <input placeholder="Seleccionar foto" class="file-path validate" type="text" name="ruta"/>
				  <div class="btn red lighten-1" style="width:auto">
					<i class="mdi-file-file-upload"></i>
					<input type="file" name="imagen" />
				  </div>
				</div>
			</div>
			<div class="col s12 m12 l6">
				<select class="browser-default" name="idcategoria" >
					<option value="<?php echo $producto['id_categoria'];?>"selected><?php echo $con->getNombreCategoria($producto['id_categoria']);?></option>
					<?php foreach( $categorias as $categoria ){ ?>
					<option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></li>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row center">
		<button class="btn waves-effect waves-light red lighten-1" type="submit">Aceptar</button>
		</div>
	  </form>
	</div>
</div>
  
<?php
}else{
?>
<div class="center">
	<br>
	<h5 class="center red-text"> PAGINA NO DISPONIBLE </h5>
	<br><img src="img/Error.jpg" width="250px"></img><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br></div> 
</div>
<?php
}
}else{
?>
<div class="center">
	<br>
	<h5 class="center red-text"> PAGINA NO DISPONIBLE </h5>
	<br><img src="img/Error.jpg" width="250px"></img><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br></div> 
</div>
<?php }

 include('includes/footer.php'); ?>