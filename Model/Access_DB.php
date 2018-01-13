<?php
//----------------------------------------------------
// DB connection function
// Use CONSTANTS defined in config.inc
//----------------------------------------------------
include '../Model/config.inc';


function ConnectDB()
{
    $mysqli = new mysqli("localhost", USER , PASS , DB);

	if ($mysqli->connect_errno) {
		include '../View/MESSAGE_View.php';
		new MESSAGE("Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error, '../index.php');
		return false;
	}
	else{
		return $mysqli;
	}
}

function Login($login, $password){

  $mysqli = ConnectDB();
  $sql = "select * from USUARIOS where login = '".$login."'";

  $result = $mysqli->query($sql);
  if ($result->num_rows == 1){  // existe el usuario
    $tupla = $result->fetch_array();
    if ($tupla['password'] == $password){ //  coinciden las passwords
      return true;
    }
    else{
      return 'La contraseña para este usuario es errónea'; //las passwords no coinciden
    }
  }
  else{
        return "El usuario no existe"; //no existe el usuario
  }

}

?>
