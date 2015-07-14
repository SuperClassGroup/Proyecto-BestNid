<?php 
session_start();
include('includes/header.php');
?>
<div class="center">
<br>
<h4>Su subasta ha sido creada correctamente</h4>
<img src="img/success.jpg" width="250px"></img><br><br>
<a class="btn red" href="Producto.php?idproducto=<?php echo $_GET['id'] ?>">VER SUBASTA</a>
<br>
</div>

<?php include('includes/footer.php'); ?>