

    	<?php

        //Vista del login
    	class Login{


    		function __construct(){
    			$this->render();
    		}

    		function render(){

    			include '../View/Header.php';

    		?>

          <form name = 'Form' id="login" action='../Controller/Login_Controller.php' method='post'>

            <div class="form-group row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Login</label>
              <div class="col-sm-5">
                  <input type="text" class="form-control" name="login"id="inputPassword" placeholder="Login">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" name="password"id="inputPassword" placeholder="Password">
              </div>
            </div>


              <button type="submit" name='action' value='Login' class="btn btn-primary">Login</button>
            </form>

    		<?php
    			include '../View/Footer.php';
    		} //fin metodo render

    	} //fin Login

    	?>
