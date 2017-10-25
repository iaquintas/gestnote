<?php
Class NOTAS_SHOWALL{
private $datos;
          private $lista;
          private $volver;
function __Construct($lista,$array){

          $this->datos = $array;
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



          <br><br>

<div class="imagenes">


                  <?php
				foreach($this->lista as $titulo){
?>



  <div class="image">
    <img id="posit" src="../View/img/nota2.png">
    <h2>Ir a casa de juan y hacer la lista de canciones que para fin de año

    <div id="botones">

  <a href="../Controller/NOTAS_Controller.php" title="Editar"><i id="iconoeditar"class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
  <a href="../Controller/NOTAS_Controller.php?action=SHARE"title="Compartir"><i id="iconocompartir"class="fa fa-bullhorn" aria-hidden="true"></i></a>
  <a href="../Controller/NOTAS_Controller.php?action=DELETE"title="Eliminar"><i id="iconoeliminar"class="fa fa-trash" aria-hidden="true"></i></a>
    <div id="pienota">
     Ignacio 16/10/2017
    </div>
    </h2>
    </div>



<?php
				}
?>
</div>

		<a href='../index.php'><img src='../View/Icons/salir.png'></a>


<?php
	include 'Footer.php';

  }

}
