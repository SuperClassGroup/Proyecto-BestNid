<?php 
session_start();
include('includes/header.php');
include('includes/modelo.class.php');
$con = new Modelo();
$categorias = $con->getAllCategories();

$error = true; 
if (isset($_POST['titulo']) && isset($_POST['descripcion'])){
	include('includes/subirImagen.class.php'); 
	$subir = new imgUpldr;
	$subir->init($_FILES['imagen']);
	if($error = $subir->_r == ""){ //SI NO HAY ERRORES CON LA CARGA DE IMAGEN
	$id = $con->setProducto($_POST['titulo'],$_POST['descripcion'],$_POST['idcategoria'],"fotos/{$subir->_name}",$_SESSION['id']);
	header("Location: /SubastaCreada.php?id={$id}");
	}
}
?>

<div class="container">
<br>
	<li class="divider"></li>
	<h5 class="center red-text">Crear Subasta</h5>
	<li class="divider"></li>
	<?php if($error == false){ ?><p class="center red-text">ERROR: <?php  echo ($subir->_r);  ?></p> <?php } ?>
	<div class="row center" >
	  <form class="col s12 " action="#" method="post" enctype="multipart/form-data">
		<div class="row">
		  <div class="input-field col s12">
			<input id="input_text" type="text" length="100" name="titulo" required >
			<label for="input_text">Titulo</label>
		  </div>
		</div>
		<div class="row">
		  <div class="input-field col s12">
			<textarea id="textarea1" class="materialize-textarea" length="500" name="descripcion" required ></textarea>
			<label for="textarea1">Descripcion</label>
		  </div>
		</div>
		<div class="row">
			<div class="col m12 l6">
				<div class="file-field">
				  <input placeholder="Seleccionar foto" class="file-path validate" required type="text"/>
				  <div class="btn red lighten-1" style="width:auto">
					<i class="mdi-file-file-upload"></i>
					<input type="file" name="imagen" />
				  </div>
				</div>
			</div>
			<div class="col s12 m12 l6">
				<select class="browser-default" name="idcategoria" required >
					<option value="" disabled selected>Seleccionar Categoria</option>
					<?php foreach( $categorias as $categoria ){ ?>
					<option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></li>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row center">
		<button class="btn waves-effect waves-light red lighten-1" type="submit">Crear</button>
		<p CLASS="center red-text">Las subastas tienen una duracion de 30 dias despues de su creacion. Luego de este plazo usted debe elegir el ganador de la subasta. </p>
		</div>
	  </form>
	</div>
</div>



<?php include('includes/footer.php'); ?>