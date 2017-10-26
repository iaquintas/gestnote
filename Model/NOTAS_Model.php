
<?php
//Modelo de la entidad: NOTAS

class NOTAS_Model{
   var $Numero;
   var $AUTOR;
   var $FECHA;
   var $CONTENIDO;
   var $mysqli;

//Constructor de la clase
public function __construct(   $Numero,   $AUTOR,   $FECHA,   $CONTENIDO,   $COMPARTIDO){
$this->Numero = $Numero;
$this->AUTOR = $AUTOR;
if($FECHA==''){
    $this->FECHA = $FECHA;
}else{
    $this->FECHA = date_format(date_create($FECHA), 'Y-m-d');
}
$this->CONTENIDO = $CONTENIDO;
$this->COMPARTIDO = $COMPARTIDO;
include_once 'Access_DB.php';
    $this->mysqli = ConnectDB();
}


//Metodo ADD que inserta una nueva instancia de la entidad comprobando que no exista previamente
public function ADD(){

         $sql = "SELECT * FROM NOTAS WHERE Numero = '$this->Numero'";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 0){
            $sql= "INSERT INTO NOTAS(Numero,AUTOR,FECHA,CONTENIDO,COMPARTIDO) VALUES ('$this->Numero','$this->AUTOR','$this->FECHA','$this->CONTENIDO','$this->COMPARTIDO')";
            if(!$this->mysqli->query($sql)){
		             return 'Error en la inserción';
            }else{
                return 'Inserción realizada con éxito';
            }
        }else{
            return 'Ya existe en la base de datos';
        }

}

    //Funcion para la destruccion de la entidad
    public function __destruct(){
    }

    //funcion de busqueda para una determinada instacia de la entidad actual
    public function SEARCH(){ //CREADAS POR USUARIO
        $log=$_SESSION['login'];
        $sql= "SELECT * FROM NOTAS WHERE (AUTOR='$log')";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            return $resultado;
        }
    }

    public function getSHARE(){ // LAS Q LE COMPARTEN
        $log=$_SESSION['login'];
        $sql= "SELECT * FROM NOTAS N, COMPARTE C WHERE N.Numero=C.Numero AND C.login='$log' AND C.BORRADO='NO'";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            return $resultado;
        }
    }


    //funcion de modificación de la instancia actual de la entidad
    public function EDIT(){
        $sql = "SELECT * FROM NOTAS WHERE (Numero = '$this->Numero')";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 0){
            return 'No existe en la base de datos';
        }else{
            $sql = "UPDATE NOTAS SET Numero = '$this->Numero',
            AUTOR = '$this->AUTOR',
            FECHA = '$this->FECHA',
            CONTENIDO = '$this->CONTENIDO',
            COMPARTIDO = '$this->COMPARTIDO' WHERE (Numero = '$this->Numero')";
            if ($resultado = $this->mysqli->query($sql)){
                return 'Modificado correctamente';
            }else{
                return 'Error en la modificación';
            }
        }
    }
    //Borra la instancia actual de la base de datos. Es un borrado completo
    public function DELETE(){
      $log=$_SESSION['login'];
      if($this->AUTOR==$log){
        //var_dump($this->AUTOR);
        $sql = "SELECT * FROM NOTAS WHERE (Numero = '$this->Numero')";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 1){
            $sql="DELETE FROM NOTAS WHERE (Numero = '$this->Numero')";
            if($this->mysqli->query($sql) === TRUE) {
    			       return 'Borrado correctamente';
    		    }
        }else{
            return 'No existe en la base de datos';
        }
      }else{
        $sql = "SELECT * FROM COMPARTE WHERE (Numero = '$this->Numero')";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 1){
            $sql="UPDATE COMPARTE SET BORRADO='SI' WHERE Numero = '$this->Numero'";
            if($this->mysqli->query($sql) === TRUE) {
    			       return 'Borrado correctamente';
    		    }
        }else{
            return 'No existe en la base de datos';
        }
      }
    }
//funcion que rellena una instancia de la entidad y la devuelve
   public function RellenaDatos(){
        $sql= "SELECT * FROM NOTAS WHERE (Numero = '$this->Numero')";
            if($resultado = $this->mysqli->query($sql)){
                $return = $resultado->fetch_array();
                return $return;
            }else{
                return 'No existe en la base de datos';
            }
        }



  }
