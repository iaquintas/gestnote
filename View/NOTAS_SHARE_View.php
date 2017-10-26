<?php
Class NOTAS_SHARE{
private $valores;function __Construct($valores){

              $this->valores = $valores;
              $this->render();
}
function render(){


              include '../Locates/Strings_SPANISH.php';
              include '../View/Header.php';

              ?>

                <h1><?php echo $strings['Compartir'] . ' NOTAS' ?></h1>

              <form name='Form' action='../Controller/NOTAS_Controller.php' method='post'   onsubmit='return comprobar_NOTAS()'>


AUTOR:<input type ='text' name ='AUTOR' size='15'  value='<?php echo ($this->valores['AUTOR']); ?>' onblur='esVacio(this)  && comprobarText(this,15)' required readonly ><br>
FECHA:<input class = 'tcal' type = 'date' name = 'FECHA' min = '' max = '' value='<?php echo ($this->valores['FECHA']); ?>'  onblur='esVacio(this)' required readonly><br>
CONTENIDO:<input type ='text' name ='CONTENIDO' size='100'  value='<?php echo ($this->valores['CONTENIDO']); ?>' onblur='esVacio(this)  && comprobarText(this,100)' required readonly ><br>
COMPARTIDO CON:<input type ='text' name ='COMPARTIDO' size='200'  value='<?php echo ($this->valores['COMPARTIDO']); ?>' onblur='esVacio(this)  && comprobarText(this,200)' required readonly ><br>


                </form>
 <a href='../Controller/NOTAS_Controller.php'><?php echo $strings['Volver']; ?> </a>
                <?php
                      include '../View/Footer.php';
                  }

                }
                ?>
