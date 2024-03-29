
<?php
//Modelo de la entidad: NOTAS

class NOTAS_Model{
   var $Numero;
   var $AUTOR;
   var $TITULO;
   var $CONTENIDO;
   var $COMPARTIDO;
   var $mysqli;

//Constructor de la clase
public function __construct(   $Numero,   $AUTOR,   $TITULO,   $CONTENIDO,   $COMPARTIDO){
$this->Numero = $Numero;
$this->AUTOR = $AUTOR;
$this->TITULO = $TITULO;
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
            $sql= "INSERT INTO NOTAS(Numero,AUTOR,TITULO,CONTENIDO,COMPARTIDO) VALUES ('0','$this->AUTOR','$this->TITULO','$this->CONTENIDO','$this->COMPARTIDO')";
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
    public function SEARCH($log){ //CREADAS POR USUARIO

        $sql= "SELECT * FROM NOTAS WHERE (AUTOR='$log')";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            return $resultado;
        }
    }

    public function getSHARE($log){ // LAS Q LE COMPARTEN


        $sql= "SELECT * FROM NOTAS N, COMPARTE C WHERE N.Numero=C.Numero AND C.login='$log' AND C.BORRADO='NO'";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            return $resultado;
        }
    }


    //funcion de modificación de la instancia actual de la entidad
    public function EDIT($log){
        $sql = "SELECT * FROM NOTAS,COMPARTE WHERE NOTAS.Numero=COMPARTE.Numero AND NOTAS.Numero = '$this->Numero' AND (NOTAS.AUTOR='$log' OR COMPARTE.login='$log')";

        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 0){
            return 'No existe en la base de datos';
        }else{
            $sql = "UPDATE NOTAS SET
            TITULO = '$this->TITULO',
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
    public function DELETE($log){

      if($this->AUTOR==$log){

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
        $sql = "SELECT * FROM COMPARTE WHERE (Numero = '$this->Numero' AND login='$this->COMPARTIDO')";

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

        public function ORDERCREATE($log){ //CREADAS POR USUARIO

            $sql= "SELECT * FROM NOTAS WHERE (AUTOR='$log') ORDER BY AUTOR";
            if (!($resultado = $this->mysqli->query($sql))){
                return 'Error en la consulta sobre la base de datos';
            }
            else{
                return $resultado;
            }
        }

        public function ORDERCREATESHARE($log){ // LAS Q LE COMPARTEN

            $sql= "SELECT * FROM NOTAS N, COMPARTE C WHERE N.Numero=C.Numero AND C.login='$log' AND C.BORRADO='NO' ORDER BY C.login";
            if (!($resultado = $this->mysqli->query($sql))){
                return 'Error en la consulta sobre la base de datos';
            }
            else{
                return $resultado;
            }
        }

        public function SHARE($log){

                 $sql = "SELECT * FROM NOTAS WHERE Numero = '$this->Numero' AND AUTOR='$log'";
                $resultado = $this->mysqli->query($sql);
                if($resultado->num_rows > 0){
                 $sql = "SELECT * FROM COMPARTE WHERE Numero = '$this->Numero' AND login='$this->COMPARTIDO'";
                 $resultado = $this->mysqli->query($sql);
                   if($resultado->num_rows > 0){
                         $sql="UPDATE COMPARTE SET BORRADO='NO' WHERE Numero = '$this->Numero' AND login='$this->COMPARTIDO'";
                   }else{

                    $sql= "INSERT INTO COMPARTE(Numero,login) VALUES ('$this->Numero','$this->COMPARTIDO')";
                  }
                    if(!$this->mysqli->query($sql)){
        		             return 'Error en la inserción';
                    }else{
                        return 'Inserción realizada con éxito';
                    }
                }else{
                    return 'Ya existe en la base de datos';
                }

        }




  }
