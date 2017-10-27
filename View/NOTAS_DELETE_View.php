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
<<<<<<< HEAD
  <a id="edit" class="navbar-brand" href="#"><?php echo $strings['Eliminar nota']; ?></a>
</nav>

            <form name='Form' action='../Controller/NOTAS_Controller.php' method='post' onsubmit='return comprobar()'>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Numero</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Numero"  placeholder="Login" value='<?php echo ($this->valores['Numero']); ?>' onblur='esVacio(this) 'required readonly><br>
                </div>
              </div>


              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">AUTOR</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="AUTOR" id="inputPassword" placeholder="Login" value='<?php echo ($this->valores['AUTOR']); ?>' onblur='esVacio(this)  && comprobarText(this,15)'required readonly><br>
                </div>
              </div>
              <div class="form-group row 5">
                <label for="staticEmail" class="col-sm-2 col-form-label">FECHA</label>
                <div class="col-sm-5">
                    <input class = "tcal" type = 'date' name = 'FECHA' min = '' max = '' value='<?php echo ($this->valores['FECHA']); ?>'onblur='esVacio(this)'required readonly  ><br>
                </div>
              </div>
              <div class="form-group row 1">
                <label for="staticEmail" class="col-sm-10 col-form-label">CONTENIDO</label>
                <div class="col-sm-10">
                    <input  type = 'text' name = 'CONTENIDO' min = '' max = '' value='<?php echo ($this->valores['CONTENIDO']); ?>'onblur='esVacio(this) && comprobarText(this,100)'required readonly  ><br>
                </div>
              </div>
              <div class="form-group row 2">
                <label for="staticEmail" class="col-sm-10 col-form-label">COMPARTIDO</label>
                <div class="col-sm-10">
                    <input  type = 'text' name = 'COMPARTIDO' min = '' max = '' value='<?php echo ($this->valores['COMPARTIDO']); ?>'onblur='esVacio(this) && comprobarText(this,200)'required readonly  ><br>
                </div>
              </div>

 <br><input type='submit' name='action' value='DELETE'>

              </form>
 <a href='../Controller/NOTAS_Controller.php'><?php echo $strings['Volver']; ?> </a>
=======
<a id="edit" class="navbar-brand" href="#"><?php echo $strings['Eliminar Nota']?></a>

</nav>

  <form name = 'Form' action='../Controller/NOTAS_Controller.php' method='post'>

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



    <div class="form-group col-md-6">
      <label for="exampleFormControlTextarea1"><?php echo$strings['COMPARTIDO']?></label>

    <div class="form-check  ">
      <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="COMPARTIDO[]"value="option1"> Juan
  </label>
    </div>

  
    </div>






  <div id="alineados">
  <button type="submit"  name='action' value='DELETE' class="btn btn-primary"><?php echo $strings['Eliminar']?></button>
  <a class="btn btn-primary" id="botoneditar" href="../Controller/NOTAS_Controller.php" role="button"><?php echo $strings['Volver']?></a>

  </div>


  </form>



>>>>>>> 7be2c751ad22017bc78ad0171f73f3c557228ebd
              <?php
                    include '../View/Footer.php';

                }

              }
              ?>
