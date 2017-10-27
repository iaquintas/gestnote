
<?php
//Modelo de la entidad: USUARIOS

class USUARIOS_Model{
   var $login;
   var $password;
   var $mysqli;

//Constructor de la clase
public function __construct($login,$password){
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
    public function __destruct(){
    }

    //funcion de busqueda para una determinada instacia de la entidad actual
    public function SEARCH(){
        $sql = "SELECT * FROM USUARIOS WHERE ((login LIKE '%$this->login%') &&
        (password LIKE '%$this->password%') &&
        (email LIKE '%$this->email%'))";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            return $resultado;
        }
    }

    //funcion de modificación de la instancia actual de la entidad
    public function EDIT(){
        $sql = "SELECT * FROM USUARIOS WHERE (login = '$this->login')";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 0){
            return 'No existe en la base de datos';
        }else{
            $sql = "UPDATE USUARIOS SET login = '$this->login',
            password = '$this->password',
            email = '$this->email' WHERE (login = '$this->login')";
            if ($resultado = $this->mysqli->query($sql)){
                return 'Modificado correctamente';
            }else{
                return 'Error en la modificación';
            }
        }
    }
    //Borra la instancia actual de la base de datos. Es un borrado completo
    public function DELETE(){
        $sql = "SELECT * FROM USUARIOS WHERE (login = '$this->login')";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 1){
            $sql="DELETE FROM USUARIOS WHERE (login = '$this->login')";
            if($this->mysqli->query($sql) === TRUE) {
    			       return 'Borrado correctamente';
    		    }
        }else{
            return 'No existe en la base de datos';
        }
    }
//funcion que rellena una instancia de la entidad y la devuelve
   public function RellenaDatos(){
        $sql= "SELECT * FROM USUARIOS WHERE (login = '$this->login')";
            if($resultado = $this->mysqli->query($sql)){
                $return = $resultado->fetch_array();
                return $return;
            }else{
                return 'No existe en la base de datos';
            }
        }
    }
