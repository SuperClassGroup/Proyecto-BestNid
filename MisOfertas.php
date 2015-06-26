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
        <a href="/Producto.php?idproducto=<?php echo $oferta['id']; ?>"><b><span class="title black-text"> <?php echo $oferta['titulo']; ?></span></b></a>
        <p>Tu Motivo: <i>"<?php echo $oferta['motivo']; ?>"</i><span class="hide-on-large-only grey-text"> / Monto Ofertado: $<?php echo $oferta['monto']; ?></span></p>
    </li>
    <?php } ?>
</ul>