<?php

	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
		include '../Locates/Strings_' . $_SESSION['idioma'] . '.php';
	}
	else{
		//$_SESSION['idioma'] = 'SPANISH'; // quitar y solucionar el problema de que inicilice el idioma a galego
		include '../Locates/Strings_' . $_SESSION['idioma'] . '.php';
	}
?>
<html>

<head>
	<meta charset="UTF-8">
	<title>Gestnote</title>
	<script type="text/javascript" src="../View/js/tcal.js"></script>
	<script type="text/javascript" src="../View/js/Validaciones.js"></script>
	<script type="text/javascript" src="../View/js/comprobar.js"></script>
	<link rel="stylesheet" type="text/css" href="../View/css/JulioCSS-2.css" media="screen" />

	<link rel="stylesheet" href="../bootsrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified CSS -->


  <link href="https://fonts.googleapis.com/css?family=Montserrat|Titillium+Web" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Merienda|Roboto|Walter+Turncoat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Philosopher|Varela+Round|Tangerine" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC" rel="stylesheet">



<link rel="stylesheet" type="text/css" href="../View/css/style.css" media="screen" />
</head>
<body>
<header>


      <div id="cabecera">
        <img id="logotipo" src="../View/img/logotipo.png">
      </div>

			<?php

				if (IsAuthenticated()){
			?>
			<div id="idioma2">
			<form action="../Controller/CambioIdioma.php" method="get">
				<?php echo $strings['idioma']; ?>
				<select name="idioma" onChange='this.form.submit()'>
			        <option value="SPANISH"> </option>
					<option value="ENGLISH"><?php echo $strings['INGLES']; ?></option>
			        <option value="SPANISH"><?php echo $strings['ESPAÑOL']; ?></option>
				</select>
			</form>
		</div>

			<div id="idioma" class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Bienvenido <?php echo $_SESSION['login']; ?>
  </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="../Functions/Desconectar.php"><img src="galicia.png">Salir</a>
        </div>
      </div>


<?php
	}
	else{
		echo $strings['Usuario no autenticado'];
		echo 	'<form action=\'../Controller/Register_Controller.php\' method=\'post\'>
					<input type=\'submit\' name=\'action\' value=\'REGISTER\'>
				</form>';
	}
?>
</header>

<div id = 'main'>
<?php
	//session_start();
	if (IsAuthenticated()){
		include '../View/menuLateral.php';
	}
?>
<article>
