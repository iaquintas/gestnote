<?php
class MESSAGE{
  private $string;
  private $volver;

  function __construct($string, $volver){
		$this->string = $string;
		$this->volver = $volver;
		$this->render();
	}
  function render(){

    include '../Locates/Strings_'.$_SESSION['idioma'].'.php';
    include '../View/Header.php';


?> <div id="lugar">
  <br> 
  <?php echo $strings[$this->string];?>
</div>
<br>



<br><a class="btn btn-primary" id="botonvuelve" href="../Controller/NOTAS_Controller.php" role="button"><?php echo $strings['Volver']?></a>
<?php

  } //fin metodo render

}
