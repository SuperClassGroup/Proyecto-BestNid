<!DOCTYPE html>
<html lang="es">
	<head>
		<title>BestNid</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="/bestnid.ico" />
		<link rel="stylesheet" href="/styles/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css" />
	</head>
	<body>
		<nav id="nav" class="red">
			<div class="nav-wrapper container">
					<a href="/" class="brand-logo" style="height:64px" ><img src="/img/logoblancogrande.png" alt="logo" style="height:64px" /></a>
					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
						<ul class="right hide-on-med-and-down">
							<li><a href="/">VER LISTADO</a></li>
							<?php if(isset($_SESSION['user'])){ ?>
								<li><a href="Perfil.php?=id_usuario"><span style="text-transform:uppercase"> <?php echo $_SESSION['user']; ?> </span> </a></li>
								<li><a href="Logout.php">SALIR</a></li>
							<?php }else{ ?>
								<li><a href="Login.php">INGRESAR</a></li>
							<?php } ?>
						</ul>
						<ul class="side-nav z-depth-2" id="mobile-demo" >
							<li class="red lighten-1"><a href="/" style="height:64px" ><img height="64px" src="/img/logoblancogrande.png"/></a></li>
							<li class="divider"></li>
							<li><a href="/">VER LISTADO</a></li>
							<?php if(isset($_SESSION['user'])){ ?>
								<li><a href="Perfil.php?=id_usuario"><span style="text-transform:uppercase"> <?php echo $_SESSION['user']; ?> </span>  </a></li>
								<li><a href="Logout.php">SALIR</a></li>
							<?php }else{ ?>
								<li><a href="Login.php">INGRESAR</a></li>
							<?php } ?>
							<li class="divider"></li>
							<li><a class="grey-text darken-2" href="/Ayuda.php">AYUDA</a></li>
							<li><a class="grey-text darken-2" href="/AcercaDe.php">ACERCA DE</a></li>
						</ul>

			</div>
		</nav>
		<main class="container z-depth-2"><div>

