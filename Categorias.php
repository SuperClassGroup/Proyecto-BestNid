<?php 

if(isset($_POST['new_categ'])){
    $con->addCategory($_POST['new_categ']);
}

if(isset($_GET['delCat'])){
    $con->removeCategory($_GET['delCat']);
}


$categorias = $con->getAllCategories(); ?>


<ul class="collection">
    <?php foreach ($categorias as $cat) { ?>
        <li class="collection-item">
            <a href="#" class="secondary-content" onclick="deleteCat(this,<?php echo $cat['id']; ?>,<?php echo $cat['items']; ?>); return false;"><i class="material-icons red-text">delete</i></a>
            <a class="grey-text text-darken-4" href="index.php?categoria=<?php echo $cat['id']; ?>"><b><?php echo $cat['nombre'] ?></b></a>
            <p class="grey-text text-darken-1" ><?php echo $cat['items'] ?> producto<?php echo ($cat['items']==1)?'':'s'; ?> activo<?php echo ($cat['items']==1)?'':'s'; ?></p>
        </li>
    <?php }?>
</ul>

<script type="text/javascript">
    function deleteCat(element,id,items){
        if(!items){
            if(confirm("Seguro desea borrar la categoria?")){
                $.get('menuAdmin.php?delCat='+id);
                $(element).parent().slideUp();
            }
        }else{
            alert("La categoria posee productos, no puede ser borrada.")
        }
    }
</script>

<div class="col s12 center">
    <form method="post" action="menuAdmin.php#Categorias">
        <div class="input-field">
			<label for="new_categ">Nueva categoría</label>
			<input name="new_categ" id="new_categ" placeholder="Nombre" type="text" maxlength="45" require />
        </div>
        <button href="#" class="btn waves-effect waves-light red lighten-1" type="submit">Agregar</button>
    </form>
</div>