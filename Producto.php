<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if(isset($_REQUEST['comentario']) && ($_REQUEST['comentario'] != "")){
	//GUARDAR EL COMENTARIO EN LA BASE DE DATOS
	$con->setComentario($_REQUEST['comentario'],$_REQUEST['idproducto'],$_SESSION['id']);
}

if( isset($_REQUEST['idproducto']) && is_numeric($_REQUEST['idproducto']) ){
	$producto = $con->getProduct($_REQUEST['idproducto']);
	$comentarios = $con->getComentarios($_REQUEST['idproducto']);
	if ($producto){



?>
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
					<p> <?php echo utf8_decode($producto['descripcion']); ?> </p>
				</div>
			</div>
			<div class="row red-text center">
				<div class="col s4">
					<span>Publicado Por:<br> <?php echo $con->getUserName($producto['id_usuario'])?></span>
				</div>
				<div class="col s4">
					<span>Fecha de inicio:<br> <?php echo $producto['fecha_ini'] ?></span>
				</div>
				<div class="col s4">
					<span>Fecha de fin:<br> <?php echo $producto['fecha_fin']?></span>
				</div>
			</div>
			<li class="divider"></li>
			<br>
			<div class="row center" >
				<div class="col s12" >
					<a class="red waves-effect waves-light btn" href="/Comprar.php?id=<?php echo $producto['id'];?>" ><i class="mdi-action-shopping-cart right"></i>comprar</a>
				</div>
			</div>
		</div>
		<div class="card-panel z-depth-1">
			<h5 class="red-text lighten-2"> Comentarios: </h5>
			<li class="divider"></li>
			<?php foreach( $comentarios as $comentario ) {?>
			<div class="card-panel grey lighten-5 z-depth-1">
				<div class="row" style="margin-bottom:0px">
					<span class="col s12">@<?php  echo $con->getUserName($comentario['id_usuario']); ?>:</span>
					<span class="col s12"><?php echo $comentario['contenido']; ?></span>
				</div>
			</div>
			<?php } ?>
			
			<?php if (!$comentarios){  ?> 
				<p class="center"> No hay comentarios</p> 
			<?php } ?>
			
			<li class="divider"></li>
			<?php if (isset($_SESSION['user'])) { ?>
			<br>
			<div class="row">
				<form method="post">
					<div class="input-field col s12">
							<textarea id="textarea1" class="materialize-textarea" length="500" name="comentario"></textarea>
							<label for="textarea1">Comentar</label>
							<input type="hidden" name="idproducto" value="<?php echo $producto['id'] ?>"> </input>
					</div>
					<div class="col s12 center">
						<button class="btn waves-effect waves-light red" type="submit" name="action">Enviar Comentario
							<i class="mdi-content-send right"></i>
						</button>
					</div>
				</form>
			</div>
			<?php } else{ ?>
			<p class="center"> Para realizar un comentario debes estar logueado  </p>
			<?php } ?>
		</div>
	</div>
</div>
<?php 
	}
	else{
		?>  <div class="center red-text"><h5>El producto solicitado no se encuentra disponible o ha finalizado</h5><br><img src="img/error.jpg" width="250px"></img><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br></div>  <?php 
	}
}
include('includes/footer.php'); ?>