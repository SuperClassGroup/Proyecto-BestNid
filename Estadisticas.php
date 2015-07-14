<?php
$ok =false;
$vacio = false;
if(isset($_POST['desde']) && isset($_POST['hasta'])){
	if($_POST['desde'] != "" || $_POST['hasta'] != "" ){
		$ok= true;
		$desde = strtotime($_POST['desde']);
		$hasta = strtotime($_POST['hasta']);
		if(!($desde < $hasta)){
			$aux = $desde; $desde = $hasta; $hasta = $aux; //INVERTIR FECHAS, EL USUARIO LAS INGRESO AL REVES.
		}
		$creadas = $con->getCreados($desde,$hasta);
		$f = $con->getFinalizados($desde,$hasta);
	}else{
		$vacio = true;
	}
}
?>

<div class="container">
	<div class="card-panel">
		<form method="post">
			<div class="row" style="margin-bottom:5px">
				<div class="col s12 center red-text"><span class="red-text">GENERAR ESTADISTICAS</span><br><br><li class="divider"></li><br><?php if($vacio){echo "ERROR: DEBE INGRESAR DOS FECHAS";?> <br><br> <?php } ?> </div>
				<div class="col s12 m6">
					<label class="right" for="desde">Desde</label>
					<input type="date" name="desde" id="desde" class="datepicker right-align" required> 
				</div>
				<div class="col s12 m6">
					<label class="left" for="hasta">Hasta</label>
					<input type="date" name="hasta" id="hasta" class="datepicker" required>
				</div>
				<div class="col s12 center">
					<button class="btn waves-effect waves-light red lighten-1" type="submit">GENERAR</button>
				</div>
			</div>
		</form>
	</div>
<?php if($ok){ ?>
	<div class="card-panel center">
		<span class="red-text">ESTADISTICAS DESDE <?php echo date('j/n/Y',$desde); ?> HASTA <?php echo date('j/n/Y',$hasta); ?></span>
		<br><br><li class="divider"></li><br>
		<div class="row">
			<div class="col s12 m6">
			<span class="red-text" style="font-size:2rem"><?php echo $creadas; ?></span><br><span>Subastas Creadas</span>
			<br><br>
			<span class="red-text" style="font-size:2rem"><?php echo $f['finalizados']; ?></span><br><span>Subastas Finalizadas</span>
			</div>
			<div class="col s12 m6">
			<span class="red-text" style="font-size:2rem"><?php echo $f['cancelados']; ?></span><br><span>Subastas Canceladas</span>
			<br><br>
			<span class="red-text" style="font-size:2rem"><?php echo $f['vencidos']; ?></span><br><span>Subastas Vencidas</span>
			</div>
		</div>
		<p class="grey-text" style="font-size:0.9rem">Creadas = Subastas que se crearon / Finalizadas = Subastas que terminaron exitosamente y tienen un ganador / Canceladas = Subastas que fueron canceladas por su dueño / Vencidas = Subastas que llegaron a su fecha fin pero no tienen ganador</p>
	</div>
<?php } ?>
</div>