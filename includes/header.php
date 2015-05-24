<!DOCTYPE html>
<html lang="es">
	<head>
		<title>BestNid</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css" />
		<link rel="stylesheet" href="/styles/main.css" />
	</head>
	 
	<body>
		<nav class="red darken-3">
			<div class="nav-wrapper container">
				<a href="/" class="brand-logo"><img src="/img/logo.png" alt="logo" style="height:64px" /></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="/">Listado</a></li>
					<?php if(isset($_SESSION['user'])){ ?>
						<li><?php echo $_SESSION['user']; ?></li>
						<li><a href="Logout.php">Salir</a></li>
					<?php }else{ ?>
						<li><a href="Login.php">Ingresar</a></li>
					<?php } ?>
				</ul>
			</div>
		</nav>
		<div class="container">