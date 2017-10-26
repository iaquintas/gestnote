<?php

    class Index {

    	function __construct(){
    		$this->render();
    	}

    	function render(){

    		include '../Locates/Strings_SPANISH.php';
    		include 'Header.php';
        include '../Functions/tieneNotas.php';

        ?>
        <body>
        <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="#"><?php echo $strings['Mis notas']; ?></a>

        <div class="navbar navbar-expand-lg" id="navbarNavDropdown">
          <ul class="navbar-nav" id="menus">
            <li class="nav-item active">
              <a class="nav-link" href="../Controller/NOTAS_Controller.php?action=ADD"><i class="fa fa-plus-square-o" aria-hidden="true"></i><?php echo(" ");echo $strings['Nueva nota']; ?></a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $strings['Ordenar por:']; ?></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#"><?php echo $strings['Creada por:']; ?></a>
                <a class="dropdown-item" href="#"><?php echo $strings['Fecha']; ?></a>

              </div>

        </li>
        </ul>




  </div>
  </nav>
   <br>
  <h1> <?php
    if(!tieneNotasShare() && !tieneNotasCreadas()){
   echo $strings['Bienvenido a Gestnote']; echo(" ");?> <?php echo $_SESSION['login'];  ?> <br> <br> <?php echo $strings['sinNotas']; ?> <br> <br> <?php echo $strings['Oportunidades']; ?>
   <br> <br> <?php echo $strings['Comenzar']; ?> </h1>


  </body>



      <?php
        include 'Footer.php';
    	}else{
        header('Location:../Controller/NOTAS_Controller.php');
      }
    }
    }
    ?>
