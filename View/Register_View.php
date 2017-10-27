
        	<?php

            //Clase de la vista del registro
        	class Register{


        		function __construct(){
        			$this->render();
        		}

        		function render(){

        			include '../View/Header.php'; //header necesita los strings
        		?>
        			<h1><?php echo $strings['Registro']; ?></h1>

              <form name = 'Form' id="register" action='../Controller/Register_Controller.php' method='post'>

                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Login</label>
                  <div class="col-sm-5">
                      <input type="text" class="form-control" name="login" placeholder="Login">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                </div>




                  <button type="submit" name='action' value='Register' class="btn btn-primary"><?php echo $strings['Registro']?></button>
                  <button type="submit" name='action' value='Volver' class="btn btn-primary"><?php echo $strings['Volver']?></button>
                </form>





        		<?php
        			include '../View/Footer.php';
        		} //fin metodo render

        	} //fin REGISTER

        	?>
