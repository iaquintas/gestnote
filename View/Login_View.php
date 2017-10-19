

    	<?php

        //Vista del login
    	class Login{


    		function __construct(){
    			$this->render();
    		}

    		function render(){

    			include '../View/Header.php';

    		?>
    			<h1><?php echo $strings['Login']; ?></h1>
    			<form name = 'Form' action='../Controller/Login_Controller.php' method='post' onsubmit='return comprobar_USUARIOS()'>

    				 	login : <input type = 'text' name = 'login' size = '15' value = '' onblur="esVacio(this)  && comprobarText(this,15)"  ><br>
    	password : <input type = 'text' name = 'password' size = '32' value = '' onblur="esVacio(this)  && comprobarText(this,32)"  ><br>

    				 <input type= 'submit' name='action' value='Login'>

    			</form>

    		<?php
    			include '../View/Footer.php';
    		} //fin metodo render

    	} //fin Login

    	?>