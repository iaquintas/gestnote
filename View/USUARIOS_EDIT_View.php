<?php 
Class USUARIOS_EDIT{
function __Construct($valores){ 

            $this->valores = $valores;
            $this->render(); 
}
function render(){ 
include '../View/Header.php'; ?>

            <h1><?php echo $strings['Modificar'] . ' USUARIOS' ?></h1>

          <form name='Form' action='../Controller/USUARIOS_Controller.php' method='post'   onsubmit='return comprobar_USUARIOS()'>


            login:<input type ='text' name ='login' size='10'  value='<?php echo ($this->valores['login']); ?>' onblur='esVacio(this)  && comprobarText(this,10)' required readonly>
<br>password:<input type ='text' name ='password' size='15'  value='<?php echo ($this->valores['password']); ?>' onblur='esVacio(this)  && comprobarText(this,15)' >
<br><input type='submit' name='action' value='EDIT'>

            </form>
 <a href='../Controller/USUARIOS_Controller.php'><?php echo $strings['Volver']; ?> </a>
            <?php
                include '../View/Footer.php';
              }

            }
            ?>
            