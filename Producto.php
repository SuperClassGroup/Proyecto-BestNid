<?php 
session_start();
include('includes/modelo.class.php');
include('includes/header.php');

$con = new Modelo();

if(isset($_REQUEST['comentario']) && ($_REQUEST['comentario'] != "")){
	//GUARDAR EL COMENTARIO EN LA BASE DE DATOS
	$con->setComentario($_REQUEST['comentario'],$_REQUEST['idproducto'],$_SESSION['id']);
}

if(isset($_REQUEST['respuesta']) && ($_REQUEST['respuesta'] != "")){
	$con->setRespuesta($_REQUEST['respuesta'],$_REQUEST['idcomentario']);
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
					<p> <?php echo $producto['descripcion']; ?> </p>
				</div>
			</div>
			<?php if($producto['estado'] == 0 ){ ?>
			<div class="row red-text center">
				<div class="col s6">
					<span>Fecha de inicio:<br> <?php echo $producto['fecha_ini'] ?></span>
				</div>
				<div class="col s6">
					<span>Fecha de fin:<br> <?php echo $producto['fecha_fin']?></span>
				</div>
				<?php
				$dias = $con->DiasRestantes($producto['fecha_fin'] );
				$total = $con->DiasDesdeHasta($producto['fecha_fin'],$producto['fecha_ini']);
				$progreso = 100 - ( ( $dias * 100 ) / $total ) ;
				?>
				<div class="col s12">
					<br>
					<div class="progress grey">
						<div class="determinate red" style="width:<?php echo $progreso;?>%"></div>
					</div>
					<p class="center grey-text"> Finaliza en <?php echo $dias;?> dias </p>
				</div>
			</div>
			<li class="divider"></li>
			<br>
			<div class="row center" >
				<div class="col s12" >
					<a class="red waves-effect waves-light btn" href="/Comprar.php?id=<?php echo $producto['id'];?>" ><i class="mdi-action-shopping-cart right"></i>comprar</a>
				</div>
			</div>
			<?php } else{ ?>
			<div class="row red-text center">
				<b><p class="red-text">ESTA SUBASTA HA FINALIZADO</p></b>
			</div>
			<?php }  ?>
		</div>
		<div class="card-panel z-depth-1">
			<h5 class="red-text lighten-2"> Comentarios: </h5>
			<li class="divider"></li>
			<?php foreach( $comentarios as $comentario ) {?>
			<div class="card-panel grey lighten-5 z-depth-1" style="margin-bottom:0px">
				<div class="row" style="margin-bottom:0px">
					<span class="col s12"><?php echo $comentario['contenido']; ?></span>
					<?php if($comentario['respuesta'] != "") { ?>
					<blockquote><span class="col s12 red-text text-lighten-1"><i class="mdi-image-navigate-next red-text"></i><?php echo $comentario['respuesta']; ?></span></blockquote>
					<?php } ?>
					<?php if((isset($_SESSION['user'])) && ($_SESSION['id'] == $producto['id_usuario']) && ($comentario['respuesta'] == "") ){ ?>
					<ul class="collapsible col s12" data-collapsible="accordion">
						<li>
							<div class="collapsible-header grey lighten-5 red-text"><i class="mdi-content-reply"></i>Responder</div>
							<div class="collapsible-body" style="margin-bottom:10px">
								<form method="post">
									<div class="input-field col s12">
											<textarea  placeholder="Responder comentario" id="textarea1" class="materialize-textarea" length="500" name="respuesta"></textarea>
											<input type="hidden" name="idcomentario" value="<?php echo $comentario['id'] ?>"> </input>
									</div>
									<div class="col s12 center">
										<button class="btn waves-effect waves-light red" type="submit" name="action">Enviar Respuesta
											<i class="mdi-content-send right"></i>
										</button>
									</div>
								</form>
							</div>
						</li>
					</ul>
					<?php }?>
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
		?> <br> <div class="center red-text"><h5>El producto solicitado no se encuentra disponible o ha finalizado</h5><img src="img/Error.jpg" width="250px"></img><br><a class="btn red" href="/">PAGINA PRINCIPAL</a><br><br></div>  <?php 
	}
}
include('includes/footer.php'); ?>