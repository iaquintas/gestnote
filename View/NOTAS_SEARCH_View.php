<?php 
Class NOTAS_SEARCH{
function __Construct(){ 
$this->render();
}
function render(){ 
include '../View/Header.php'; ?>

        <h1><?php echo $strings['Buscar'] . ' NOTAS' ?></h1>

      <form name='Form' action='../Controller/NOTAS_Controller.php' method='post'   onsubmit='return comprobar()'>


        AUTOR:<input type ='text' name ='AUTOR' size='15'  value='' onblur='comprobarText(this,15)' >
 <br>FECHA:<input class = 'tcal' type = 'date' name = 'FECHA' min = '' max = '' value = '' onblur='validarFecha(this)' > 
 <br>CONTENIDO:<input type ='text' name ='CONTENIDO' size='100'  value='' onblur='comprobarText(this,100)' >
 <br>COMPARTIDO:<input type ='text' name ='COMPARTIDO' size='200'  value='' onblur='comprobarText(this,200)' >
 <br><input type='submit' name='action' value='SEARCH'>

        </form>
 <a href='../Controller/NOTAS_Controller.php'><?php echo $strings['Volver']; ?> </a>
        <?php
            include '../View/Footer.php';
          }

        }
        ?>
        