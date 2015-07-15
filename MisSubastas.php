<?php 
	$productos = $con->getProductsOfUser($_SESSION['id']);
?>
<?php if (empty($productos)){ ?> <p class="col s12 red-text center"> NO SE ENCONTRARON SUBASTAS </p> <?php } ?> 
<ul class="collection">
	<li class="collection-item">
	<div class="center"> <a class="red-text" href="CrearSubasta.php"> CREAR NUEVA SUBASTA </a> </div>
	</li>
	<?php foreach( $productos as $producto ){ ?>
	<li class="collection-item avatar">
		<img src="<?php echo $producto['foto']; ?>" alt="" class="circle">
		<a class="tooltipped" data-position="top" data-delay="60" data-tooltip="Ver subasta" href="Producto.php?idproducto=<?php echo $producto['id']; ?>"><b><span class="title black-text"> <?php echo $producto['titulo']; ?></span></b></a>
		<p class="truncate"> <?php echo $producto['descripcion']; ?> <br> 
			<?php			
			switch ($producto['estado']) {
				case 0:
					?>
					<a href="Producto.php?idproducto=<?php echo $producto['id']; ?>"><u class="green-text text-lighten-2">Subasta activa</u></a> -
					<a href="editarProducto.php?id=<?php echo $producto['id']; ?>" ><u class="blue-text text-lighten-2">Editar</u></a> -
					<a href="cancelarProducto.php?id=<?php echo $producto['id']; ?>" ><u class="red-text text-lighten-2">Cancelar</u></a><?php
					break;
				case 2:
					?><a href="elegirGanador.php?id=<?php echo $producto['id']; ?>"><u class="orange-text">Seleccionar Ganador</u></a><?php
					break;
				case 1:
					?><span class="red-text">Subasta Finalizada</span> <?php
					break;
				case 3:
					?><span class="red-text">Subasta Cancelada</span> <?php
					break;
			}?>	
		</p>
	</li>
	<?php } ?>
</ul>



  
  