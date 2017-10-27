
<?php
//Modelo de la entidad: USUARIOS

class USUARIOS_Model{
   var $login;
   var $mysqli;

//Constructor de la clase
public function __construct(   $login,   $password){
$this->login = $login;
$this->password = $password;
include_once 'Access_DB.php';
    $this->mysqli = ConnectDB();
}


//Metodo ADD que inserta una nueva instancia de la entidad comprobando que no exista previamente
public function ADD(){
    if(($this->login <> '')){
         $sql = "SELECT * FROM USUARIOS WHERE login = '$this->login'";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 0){
            $sql= "INSERT INTO USUARIOS(login,password) VALUES ('$this->login','$this->password')";
            if(!$this->mysqli->query($sql)){
		             return 'Error en la inserción';
            }else{
                return 'Inserción realizada con éxito';
            }
        }else{
            return 'Ya existe en la base de datos';
        }
    }else{
        return 'Introduzca un valor';
    }
}

    //Funcion para la destruccion de la entidad

    }
