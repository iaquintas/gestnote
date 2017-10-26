<?php
include_once '../Model/Access_DB.php';


 function tieneNotas(){
        $mysqli = ConnectDB();
        $log=$_SESSION['login'];
        $sql= "SELECT * FROM NOTAS N, COMPARTE C WHERE N.Numero=C.Numero AND (N.AUTOR='$log' OR C.login='$log')";
        $resultado = $mysqli->query($sql);
        if($resultado->num_rows > 0){
          return true;
        }else{
          return false;
        }
  }



 ?>
