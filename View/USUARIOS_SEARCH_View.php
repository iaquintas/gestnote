<?php 
Class USUARIOS_SEARCH{
function __Construct(){ 
$this->render();
}
function render(){ 
include '../View/Header.php'; ?>

        <h1><?php echo $strings['Buscar'] . ' USUARIOS' ?></h1>

      <form name='Form' action='../Controller/USUARIOS_Controller.php' method='post'   onsubmit='return comprobar()'>


        login:<input type ='text' name ='login' size='10'  value='' onblur='comprobarText(this,10)' >
 <br>password:<input type ='text' name ='password' size='15'  value='' onblur='comprobarText(this,15)' >
 <br><input type='submit' name='action' value='SEARCH'>

        </form>
 <a href='../Controller/USUARIOS_Controller.php'><?php echo $strings['Volver']; ?> </a>
        <?php
            include '../View/Footer.php';
          }

        }
        ?>
        