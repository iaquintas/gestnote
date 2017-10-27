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
              <?php
                    include '../View/Footer.php';

                }

              }
              ?>
