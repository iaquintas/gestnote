<?php
include_once '../Model/Access_DB.php';


 function tieneNotasShare(){
        $mysqli = ConnectDB();
        $log=$_SESSION['login'];
        $sql= "SELECT * FROM NOTAS N, COMPARTE C WHERE N.Numero=C.Numero AND C.login='$log' AND C.BORRADO='NO'";
        $resultado = $mysqli->query($sql);
        if($resultado->num_rows > 0){
          return true;
        }else{
          return false;
        }
  }

  function tieneNotasCreadas(){
         $mysqli = ConnectDB();
         $log=$_SESSION['login'];
           $sql= "SELECT * FROM NOTAS WHERE (AUTOR='$log')";
         $resultado = $mysqli->query($sql);
         if($resultado->num_rows > 0){
           return true;
         }else{
           return false;
         }
   }





 ?>
