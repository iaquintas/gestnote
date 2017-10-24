
<?php
//Modelo de la entidad: NOTAS

class NOTAS_Model{
   var $AUTOR;
   var $FECHA;
   var $CONTENIDO;
   var $mysqli;

//Constructor de la clase
public function __construct(   $AUTOR,   $FECHA,   $CONTENIDO,   $COMPARTIDO){
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
    if(AUTOR,FECHA,CONTENIDO,COMPARTIDO) VALUES ('$this->AUTOR','$this->FECHA','$this->CONTENIDO','$this->COMPARTIDO')";
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
        $sql = "SELECT * FROM NOTAS WHERE ((AUTOR LIKE '%$this->AUTOR%') &&
        (FECHA LIKE '%$this->FECHA%') &&
        (CONTENIDO LIKE '%$this->CONTENIDO%') &&
        (COMPARTIDO LIKE '%$this->COMPARTIDO%'))";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            return $resultado;
        }
    }

    //funcion de modificación de la instancia actual de la entidad
    public function EDIT(){
        $sql = "SELECT * FROM NOTAS WHERE (AUTOR = '$this->AUTOR',
            FECHA = '$this->FECHA',
            CONTENIDO = '$this->CONTENIDO',
            COMPARTIDO = '$this->COMPARTIDO' WHERE (
    //Borra la instancia actual de la base de datos. Es un borrado completo
    public function DELETE(){
        $sql = "SELECT * FROM NOTAS WHERE (
//funcion que rellena una instancia de la entidad y la devuelve
   public function RellenaDatos(){
        $sql= "SELECT * FROM NOTAS WHERE (