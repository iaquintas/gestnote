<?php
Class NOTAS_SHOWALL{
          private $datos;
          private $datos2;
          private $lista;
          private $volver;

function __Construct($lista,$array,$array2){

          $this->datos = $array;
          $this->datos2 = $array2;
          $this->lista = $lista;
          $this->render();
}
function render(){
include '../View/Header.php'; ?>

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

    

    <div class="imagenes">


              <?php
              foreach($this->datos as $datos){
              ?>

      <div class="image">
        <img id="posit" src="../View/img/nota2.png">
        <h2> <?php echo $datos["CONTENIDO"]; ?>
          <div id="botones">

              <a href="../Controller/NOTAS_Controller.php?Numero=<?php echo $datos['Numero']; ?>&action=EDIT" title="Editar"><i id="iconoeditar"class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <a href="../Controller/NOTAS_Controller.php?Numero=<?php echo $datos['Numero']; ?>&action=SHARE"><i id="iconocompartir"class="fa fa-bullhorn" aria-hidden="true"></i></a>
              <a href="../Controller/NOTAS_Controller.php?Numero=<?php echo $datos['Numero']; ?>&action=DELETE"><i id="iconoeliminar"class="fa fa-trash" aria-hidden="true"></i></a>
                <div id="pienota">
                  <?php echo $datos["AUTOR"]; echo(" ");  echo $datos["FECHA"]; ?>
                </div>
                </h2>
        </div>

    <?php

              }

    ?>


    <?php
    foreach($this->datos2 as $datos2){
    ?>

        <div class="image">
        <img id="posit" src="../View/img/nota2.png">
        <h2> <?php echo $datos2["CONTENIDO"]; ?>
        <div id="botones">

            <a href="../Controller/NOTAS_Controller.php?Numero=<?php echo $datos2['Numero']; ?>&action=EDIT" title="Editar"><i id="iconoeditar"class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="../Controller/NOTAS_Controller.php?Numero=<?php echo $datos2['Numero']; ?>&action=SHARE"><i id="iconocompartir"class="fa fa-bullhorn" aria-hidden="true"></i></a>
            <a href="../Controller/NOTAS_Controller.php?Numero=<?php echo $datos2['Numero']; ?>&action=DELETE"><i id="iconoeliminar"class="fa fa-trash" aria-hidden="true"></i></a>
              <div id="pienota">
                <?php echo $datos2["AUTOR"]; echo(" ");  echo $datos2["FECHA"]; ?>
              </div>
              </h2>
        </div>

        <?php

            }

        ?>
        </div>



</div>



    <?php
    	include 'Footer.php';

      }

    }
