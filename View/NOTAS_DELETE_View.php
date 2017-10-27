<?php
Class NOTAS_DELETE{
private $valores;
function __Construct($valores){

              $this->valores = $valores;
              $this->render();
}
function render(){
include '../View/Header.php'; ?>

<nav class="navbar navbar-expand-lg">

  <a id="edit" class="navbar-brand" href="#"><?php echo $strings['Eliminar Nota']?></a>
</nav>


  <form name = 'Form' action='../Controller/NOTAS_Controller.php' method='post'>


    <div class="form-group col-md-6">
      <label for="inputEmail4" class="col-form-label"><?php echo $strings['Numero']?></label>
      <input type="number" class="form-control" name="Numero" value="<?php echo ($this->valores['Numero']);?>" placeholder="Numero" readonly>
    </div>


      <div class="form-group col-md-6">
        <label for="inputEmail4" class="col-form-label"><?php echo $strings['AUTOR']?></label>
        <input type="text" class="form-control" id="Autor" name='AUTOR' value="<?php echo ($this->valores['AUTOR']);?>" placeholder="Autor" readonly>
      </div>


    <div class="form-group col-md-6">
      <label for="inputAddress" class="col-form-label"><?php echo $strings['FECHA']?></label>
      <input type="date" class="form-control" id="Fecha" name='FECHA' value="<?php echo ($this->valores['FECHA']);?>" placeholder="Fecha" readonly>
    </div>

    <div class="form-group col-md-6">
      <label for="exampleFormControlTextarea1"><?php echo $strings['CONTENIDO']?></label>
      <textarea class="form-control" id="Contenido"  name='CONTENIDO' rows="3" readonly><?php echo ($this->valores['CONTENIDO']);?></textarea>
    </div>

  <div id="alineados">
  <button type="submit" id="botoneditar" name='action' value='DELETE' class="btn btn-primary"><?php echo $strings['Eliminar']?></button>
  <a class="btn btn-primary" id="botoneditar" href="../Controller/NOTAS_Controller.php" role="button"><?php echo $strings['Volver']?></a>

  </div>


  </form>




              <?php
                    include '../View/Footer.php';

                }

              }
              ?>
