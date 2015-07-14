<!DOCTYPE html>
<html lang="es">
	<head>
		<title>BestNid</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<link rel="shortcut icon" href="bestnid.ico" />
		<link rel="stylesheet" href="styles/main.css" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
	</head>
	<body>
		<nav id="nav" class="red">
			<div class="nav-wrapper container">
					<a href="index.php" class="brand-logo" style="height:64px" ><img src="img/logoblancogrande.png" alt="logo" style="height:64px" /></a>
					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
						<ul class="right hide-on-med-and-down">
							<li><a href="index.php">VER LISTADO</a></li>
							<?php if(isset($_SESSION['user'])){ ?>
								<li><a href="CrearSubasta.php">SUBASTAR</a></li>
								<li><a href="Perfil.php"><span style="text-transform:uppercase"> <?php echo $_SESSION['user']; ?> </span> </a></li>
								<li><a href="Logout.php">SALIR</a></li>
								<?php
								if($_SESSION['admin']){ ?><li><a href="menuAdmin.php"><i class="white-text material-icons" style="font-size:1.4rem">security</i></a></li><?php }
								?>
							<?php }else{ ?>
								<li><a href="register.php">REGISTRARSE</a></li>
								<li><a href="Login.php">INGRESAR</a></li>
							<?php } ?>
						</ul>
						<ul class="side-nav z-depth-2" id="mobile-demo">
							<li class="red lighten-1"><a href="index.php" style="height:64px" ><img height="64px" src="img/logoblancogrande.png"/></a></li>
							<li class="divider"></li>
							<li><a href="index.php">VER LISTADO</a></li>
							<?php if(isset($_SESSION['user'])){ ?>
								<li><a href="CrearSubasta.php">SUBASTAR</a></li>
								<li><a href="Perfil.php"><span style="text-transform:uppercase"> <?php echo $_SESSION['user']; ?> </span>  </a></li>
								<li><a href="Logout.php">SALIR</a></li>
							<?php }else{ ?>
								<li><a href="register.php">REGISTRARSE</a></li>
								<li><a href="Login.php">INGRESAR</a></li>
							<?php } ?>
							<li class="divider"></li>
							<li><a class="grey-text darken-2" href="Ayuda.php">AYUDA</a></li>
							<li><a class="grey-text darken-2" href="AcercaDe.php">ACERCA DE</a></li>
							<li><a class="grey-text darken-2" href="contacto.php">CONTACTO</a></li>
						</ul>

			</div>
		</nav>
		<main class="container z-depth-2"><div>

