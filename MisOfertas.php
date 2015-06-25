<?php 
    $ofertas = $con->getMisOfertas();
?>
<?php if (empty($ofertas)){ ?> <p class="col s12 red-text center"> NO HAS REALIZADO OFERTAS </p> <?php } ?> 
<ul class="collection">
    <?php foreach( $ofertas as $oferta ){ ?>
    <li class="collection-item">
        <span class="secondary-content">$ <?php echo $oferta['monto']; ?></span>
        <a href="/Producto.php?idproducto=<?php echo $oferta['id']; ?>"><b><span class="title black-text"> <?php echo $oferta['titulo']; ?></span></b></a>
        <p class="truncate"><i><?php echo $oferta['motivo']; ?></i></p>
    </li>
    <?php } ?>
</ul>