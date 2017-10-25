<?php

    class Index {

    	function __construct(){
    		$this->render();
    	}

    	function render(){

    		include '../Locates/Strings_SPANISH.php';
    		include 'Header.php';

        ?>
        <body>
        <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="#"><?php echo $strings['Mis notas']; ?></a>

        <div class="navbar navbar-expand-lg" id="navbarNavDropdown">
          <ul class="navbar-nav" id="menus">
            <li class="nav-item active">
              <a class="nav-link" href="../Controller/NOTAS_Controller.php?action=Add"><i class="fa fa-plus-square-o" aria-hidden="true"></i><?php echo(" ");echo $strings['Nueva nota']; ?></a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $strings['Ordenar por:']; ?></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#"><?php echo $strings['Creada por:']; ?></a>
                <a class="dropdown-item" href="#"><?php echo $strings['Fecha']; ?></a>

              </div>
        </div>
        </li>
        </ul>




  </div>
  </nav>

  <div class="imagenes">

    <div class="image">
      <img id="posit" src="../View/img/nota2.png">
      <h2>Ir a casa de juan y hacer la lista de canciones que para fin de año

      <div id="botones">

    <a href="../Controller/NOTAS_Controller.php?action=edit" title="Editar"><i id="iconoeditar"class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    <a href="../Controller/NOTAS_Controller.php?action=compartir"title="Compartir"><i id="iconocompartir"class="fa fa-bullhorn" aria-hidden="true"></i></a>
    <a href="../Controller/NOTAS_Controller.php?action=eliminar"title="Eliminar"><i id="iconoeliminar"class="fa fa-trash" aria-hidden="true"></i></a>
      <div id="pienota">
       Ignacio 16/10/2017
      </div>
      </h2>
      </div>

    </div>








  </body>



      <?php
      include 'Footer.php';
    	}

    }
    ?>
