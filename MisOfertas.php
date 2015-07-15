<?php 
    $ofertas = $con->getMisOfertas();
?>
<?php if (empty($ofertas)){ ?> <p class="col s12 red-text center"> NO HAS REALIZADO OFERTAS </p> <?php } ?> 
<ul class="collection">
    <?php foreach( $ofertas as $oferta ){ ?>
    <li class="collection-item avatar">
		<img src="<?php echo $oferta['foto']; ?>" alt="" class="circle">
		<div class="secondary-content  hide-on-med-and-down">
		<span class="grey-text right" style="font-size:0.8rem">MONTO</span><br>
        <span class="green-text" style="font-size:2.5rem; margin-top:15px;">$ <?php echo $oferta['monto']; ?></span>
		</div>
        <a class="truncate" href="Producto.php?idproducto=<?php echo $oferta['id']; ?>"><b><span class="title black-text"> <?php echo $oferta['titulo']; ?></span></b></a>
        <p class="truncate">Tu Motivo: <i>"<?php echo $oferta['motivo']; ?>"</i><br>
		<?php if($oferta['canceled']){ ?><span class="red-text">Esta oferta fue cancelada</span> <?php }else{	
			switch ($oferta['estado']) {
				case 0:
					?>
					<span class="green-text text-lighten-2">Subasta activa</span><?php
					break;
				case 2: ?>
					<span class="orange-text">En seleccion de Ganador</span><?php
					break;
				case 1: ?>
					<span class="red-text">Subasta Finalizada</span> <?php
					break;
				case 3: ?>
					<span class="red-text">Subasta Cancelada</span> <?php
					break;
			}
		}?>	
		<span class="hide-on-large-only grey-text">Monto Ofertado: $<?php echo $oferta['monto']; ?></span>
		</p>
    </li>
    <?php } ?>
</ul>