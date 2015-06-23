<?php
if(isset($_POST['desde']) && isset($_POST['hasta'])){
	//GENERAR ESTADISTICAS
}
?>

<div class="container">
	<div class="card-panel">
		<form method="post">
			<div class="row" style="margin-bottom:5px">
				<div class="col s12 center"><span class="red-text">GENERAR ESTADISTICAS</span><br><br><li class="divider"></li><br></div>
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
</div>