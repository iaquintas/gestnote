<?php
Class NOTAS_EDIT{
function __Construct($valores){

            $this->valores = $valores;
            $this->render();
}
function render(){
include '../View/Header.php'; ?>

            <h1><?php echo $strings['Modificar'] . ' NOTAS' ?></h1>

          <form name='Form' action='../Controller/NOTAS_Controller.php' method='post'   onsubmit='return comprobar_NOTAS()'>

NUMERO:<input type ='text' name ='Numero' size='15'  value='<?php echo ($this->valores['Numero']); ?>' onblur='esVacio(this)' readonly>
AUTOR:<input type ='text' name ='AUTOR' size='15'  value='<?php echo ($this->valores['AUTOR']); ?>' onblur='esVacio(this)  && comprobarText(this,15)' readonly>
<br>FECHA:<input class = 'tcal' type = 'date' name = 'FECHA' min = '' max = '' value='<?php echo ($this->valores['FECHA']); ?>'  onblur='esVacio(this) && validarFecha(this)' > <br>
CONTENIDO:<input type ='text' name ='CONTENIDO' size='100'  value='<?php echo ($this->valores['CONTENIDO']); ?>' onblur='esVacio(this)  && comprobarText(this,100)' >
<br>COMPARTIDO:<input type ='text' name ='COMPARTIDO' size='200'  value='<?php echo ($this->valores['COMPARTIDO']); ?>' onblur='esVacio(this)  && comprobarText(this,200)' >
<br><input type='submit' name='action' value='EDIT'>

            </form>
 <a href='../Controller/NOTAS_Controller.php'><?php echo $strings['Volver']; ?> </a>
            <?php
                include '../View/Footer.php';
              }

            }
            ?>
