<?php
Class NOTAS_ADD{
function __Construct(){
$this->render();
}
function render(){
include '../View/Header.php';
include '../Functions/tieneNotas.php';

?>

<nav class="navbar navbar-expand-lg">
<a id="edit" class="navbar-brand" href="#"><?php echo $strings['Añadir Nota']?></a>

</nav>

  <form name = 'Form' action='../Controller/NOTAS_Controller.php' method='post'>



    <div class="form-group col-md-6">
      <label for="inputAddress" class="col-form-label"><?php echo $strings['FECHA']?></label>
      <input type="date" class="form-control" name="FECHA"  placeholder="Fecha" >
    </div>

    <div class="form-group col-md-6">
      <label for="exampleFormControlTextarea1"><?php echo $strings['CONTENIDO']?></label>
      <textarea class="form-control" name="CONTENIDO"  rows="3" ></textarea>
    </div>






  <div id="alineados">
  <button type="submit"  id="botoneditar"name='action' value='ADD' class="btn btn-primary"><?php echo $strings['Añadir Nota']?></button>
  <a class="btn btn-primary" id="botoneditar" href="../Controller/NOTAS_Controller.php" role="button"><?php echo $strings['Volver']?></a>

  </div>


  </form>



              <?php
                    include '../View/Footer.php';

                }

              }
              ?>
