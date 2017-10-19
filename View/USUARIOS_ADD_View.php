<?php 
Class USUARIOS_ADD{
function __Construct(){ 
$this->render();
}
function render(){ 
include '../View/Header.php';?>

        <h1><?php echo $strings['Insertar'] . ' USUARIOS' ?></h1>

      <form name='Form' action='../Controller/USUARIOS_Controller.php' method='post'   onsubmit='return comprobar_USUARIOS()'>


        login :<input type ='text' name ='login' size='10'  value='' onblur='esVacio(this) && comprobarText(this,10)' ><br>
password :<input type ='text' name ='password' size='15'  value='' onblur='esVacio(this) && comprobarText(this,15)' ><br>
<input type='submit' name='action' value='ADD'>

        </form>
 <a href='../Controller/USUARIOS_Controller.php'>Volver </a>
        <?php
            include '../View/Footer.php';
          }

        }
        ?>
        