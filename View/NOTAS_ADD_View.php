<?php
Class NOTAS_ADD{
function __Construct(){
$this->render();
}
function render(){
include '../View/Header.php';?>

        <h1><?php echo $strings['Insertar'] . ' NOTAS' ?></h1>

      <form name='Form' action='../Controller/NOTAS_Controller.php' method='post'   onsubmit='return comprobar_NOTAS()'>



<?php echo $strings['FECHA'] ?> :<input class = 'tcal' type = 'date' name = 'FECHA' min = '' max = '' value = '' onblur='esVacio(this) && validarFecha(this)' ><br>
<?php echo $strings['CONTENIDO'] ?>  :<input type ='text' name ='CONTENIDO' size='100'  value='' onblur='esVacio(this) && comprobarText(this,100)' ><br>
<?php echo $strings['COMPARTIDO'] ?> :<input type ='text' name ='COMPARTIDO' size='200'  value='' onblur='esVacio(this) && comprobarText(this,200)' ><br>
<input type='submit' name='action' value='ADD'>

        </form>
 <a href='../Controller/NOTAS_Controller.php'><?php echo $strings['Volver'] ?> </a>
        <?php
            include '../View/Footer.php';
          }

        }
        ?>
