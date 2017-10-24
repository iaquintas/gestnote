
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

                <div class="form-group row">
                   <label for="email" class="col-sm-2 col-form-label">Email</label>
                   <div class="col-sm-5">
                     <input type="email" class="form-control" name="email"  placeholder="Email">
                   </div>
                 </div>


                  <button type="submit" name='action' value='Register' class="btn btn-primary">Register</button>
                  <button type="submit" name='action' value='Volver' class="btn btn-primary">Volver</button>
                </form>


        			<a href='../Controller/USUARIOS_Controller.php'>Volver </a>


        		<?php
        			include '../View/Footer.php';
        		} //fin metodo render

        	} //fin REGISTER

        	?>
