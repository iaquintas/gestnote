<?php 
Class USUARIOS_SHOWALL{
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

            <h1><?php echo $strings['Mostrar todos']. ' USUARIOS' ?></h1>
             <a href='../Controller/USUARIOS_Controller.php?action=SEARCH'><img src= '../View/Icons/search.png' ></a></a>
            <a href='../Controller/USUARIOS_Controller.php?action=ADD'><img src= '../View/Icons/add.png' ></a></br></br>

          <form name='Form' action='../Controller/USUARIOS_Controller.php' method='post'   onsubmit='return comprobar_USUARIOS()'>

          <br><br>

          <table border = 1>
                  <tr>

                  <?php
				foreach($this->lista as $titulo){
?>
					<th>
<?php
						echo $strings[$titulo];
?>
					</th>
<?php
				}
?>			</tr>
<?php
				foreach($this->datos as $datos){
?>
					<tr>
<?php
						for($i=0;$i<count($this->lista);$i++){
?>
							<td>
<?php
								echo $datos[$this->lista[$i]];
?>
							</td>
<?php
				}
?>


<td><a href='USUARIOS_Controller.php?login=<?php echo $datos['login']; ?>&action=EDIT'>
      <img src='../View/Icons/edit.png'>
    </a>
  </td>

<td><a href='USUARIOS_Controller.php?login=<?php echo $datos['login']; ?>&action=DELETE'>
      <img src='../View/Icons/delete.png'>
    </a>
  </td>

<td><a href='USUARIOS_Controller.php?login=<?php echo $datos['login']; ?>&action=SHOWCURRENT'>
      <img src='../View/Icons/detalle.png'>
    </a>
    </td>
  	</tr>
<?php
				}
?>
		</table>

		<a href='../index.php'><img src='../View/Icons/salir.png'></a>


<?php
	include 'Footer.php';

  }

}