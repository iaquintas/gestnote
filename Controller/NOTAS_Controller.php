<?php

    //Controller de la entidad: NOTAS

    session_start();
    include '../Functions/Authentication.php';

	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

    //includes necesarios
    include '../Model/NOTAS_Model.php';
    include '../View/NOTAS_SHOWALL_View.php';
    include '../View/NOTAS_SEARCH_View.php';
    include '../View/NOTAS_ADD_View.php';
    include '../View/NOTAS_EDIT_View.php';
    include '../View/NOTAS_DELETE_View.php';
    include '../View/NOTAS_SHARE_View.php';
    include '../View/MESSAGE_View.php';
    include '../Locates/Strings_SPANISH.php';
        include '../Locates/Strings_ENGLISH.php';

    //funcion que recoge los datos de las vistas
    function get_data_form(){
        $Numero = $_REQUEST['Numero'];
        $AUTOR = $_REQUEST['AUTOR'];
        $TITULO = $_REQUEST['TITULO'];
        $CONTENIDO = $_REQUEST['CONTENIDO'];
        $COMPARTIDO = $_POST['COMPARTIDO'];


        $NOTAS = new NOTAS_Model($Numero,$AUTOR,$TITULO,$CONTENIDO,$COMPARTIDO);
        return $NOTAS;
    }

    if(!isset($_REQUEST['action'])){
        $_REQUEST['action'] = '';
    }

    //switch para las distintas vistas
    Switch ($_REQUEST['action']){
        //Añade un nuevo NOTAS
        case 'ADD':
            if (!$_POST){
                new NOTAS_ADD();
            }else{
              $Numero = "";
              $AUTOR = $_SESSION['login'];
              $TITULO = $_REQUEST['TITULO'];
              $CONTENIDO = $_REQUEST['CONTENIDO'];
              $COMPARTIDO = "";

              $NOTAS = new NOTAS_Model($Numero,$AUTOR,$TITULO,$CONTENIDO,$COMPARTIDO);
                $respuesta = $NOTAS->ADD();
                new MESSAGE($respuesta, '../Controller/NOTAS_Controller.php');
            }
            break;
        //Realiza un borrado
        case 'DELETE':
            if (!$_POST){
                $NOTAS = new NOTAS_Model($_REQUEST['Numero'],'','','','');
                $valores= $NOTAS->RellenaDatos($_REQUEST['Numero']);
                new NOTAS_DELETE($valores);
            }else{
              $log=$_SESSION['login'];
              $Numero = $_REQUEST['Numero'];
              $AUTOR = $_REQUEST['AUTOR'];
              $TITULO = $_REQUEST['TITULO'];
              $CONTENIDO = $_REQUEST['CONTENIDO'];
              $COMPARTIDO = $_SESSION['login'];


              $NOTAS = new NOTAS_Model($Numero,$AUTOR,$TITULO,$CONTENIDO,$COMPARTIDO);
                $respuesta = $NOTAS->DELETE($log);
                new MESSAGE($respuesta, '../Controller/NOTAS_Controller.php');
            }
            break;
        //Edita los datos que quiera el usuario
        case 'EDIT':
          $log=$_SESSION['login'];
            if (!$_POST){
                $NOTAS = new NOTAS_Model($_REQUEST['Numero'],'','','','');
                $valores= $NOTAS->RellenaDatos($_REQUEST['Numero']);
                new NOTAS_EDIT($valores);
            }else{
              $Numero =$_REQUEST['Numero'];
              $AUTOR = $_SESSION['login'];
              $TITULO = $_REQUEST['TITULO'];
              $CONTENIDO = $_REQUEST['CONTENIDO'];
              $COMPARTIDO = "";
                $NOTAS = new NOTAS_Model($Numero,$AUTOR,$TITULO,$CONTENIDO,$COMPARTIDO);
                $respuesta = $NOTAS->EDIT($log);
                new MESSAGE($respuesta, '../Controller/NOTAS_Controller.php');
            }
            break;
        //Busca la entidad deseada
        case 'SEARCH':
            if (!$_POST){
                new NOTAS_SEARCH();
            }else{
                $log=$_SESSION['login'];
                $NOTAS = get_data_form();
                $datos = $NOTAS->SEARCH($log);
                $datos2= $NOTAS->getSHARE($log);

                $lista = array( 'Numero', 'AUTOR', 'TITULO', 'CONTENIDO', 'COMPARTIDO');
                new NOTAS_SHOWALL($lista, $datos,$datos2,'../index.php');
            }
            break;
        //Muestra el/la NOTAS seleccionado
        case 'SHARE':
              $log=$_SESSION['login'];
            if (!$_POST){
                $NOTAS = new NOTAS_Model($_REQUEST['Numero'],'','','','');
                $valores= $NOTAS->RellenaDatos($_REQUEST['Numero']);
                new NOTAS_SHARE($valores);
            }else{
              $Numero = $_REQUEST['Numero'];
              $AUTOR = $_SESSION['login'];
              $TITULO = $_REQUEST['TITULO'];
              $CONTENIDO = $_REQUEST['CONTENIDO'];
              $COMPARTIDO=array();

              if(isset($_POST['COMPARTIDO'])){
                    $COMPARTIDO = $_POST['COMPARTIDO'];
                }else{
                    $COMPARTIDO = "";#default value
                }


                if($COMPARTIDO == ""){
                  $noUsers="Nomensajes";
                    new MESSAGE("$noUsers", '../Controller/NOTAS_Controller.php');
                }else{
              foreach ($COMPARTIDO as $com) {

                $NOTAS = new NOTAS_Model($Numero,$AUTOR,$TITULO,$CONTENIDO,$com);
                  $respuesta = $NOTAS->SHARE($log);
              }

                new MESSAGE($respuesta, '../Controller/NOTAS_Controller.php');
            }
          }
            break;

        case 'ORDERCREATE':
        if (!$_POST){
            $NOTAS = new NOTAS_Model( '', '', '', '', '');
        }else{
            $NOTAS = get_data_form();
          }
            $log=$_SESSION['login'];
            $datos = $NOTAS->ORDERCREATE($log);
            $datos2= $NOTAS->ORDERCREATESHARE($log);

            $lista = array( 'Numero', 'AUTOR', 'TITULO', 'CONTENIDO', 'COMPARTIDO');
            new NOTAS_SHOWALL($lista, $datos,$datos2,'../index.php');

          break;

          case 'ORDERSHARE':
          if (!$_POST){
              $NOTAS = new NOTAS_Model( '', '', '', '', '');
          }else{
              $NOTAS = get_data_form();
            }
              $datos2= $NOTAS->ORDERCREATESHARE($log);
              $datos = $NOTAS->ORDERCREATE($log);


              $lista = array( 'Numero', 'AUTOR', 'TITULO', 'CONTENIDO', 'COMPARTIDO');
              new NOTAS_SHOWALL($lista, $datos2,$datos,'../index.php');

            break;



        //Opcion por defecto, que muestra todas las instancias de la entidad
        default:
            $log=$_SESSION['login'];
            if (!$_POST){
                $NOTAS = new NOTAS_Model( '', '', '', '', '');
            }else{
                $NOTAS = get_data_form();
            }
            $datos = $NOTAS->SEARCH($log);
            $datos2= $NOTAS->getSHARE($log);

            $lista = array( 'Numero', 'AUTOR', 'TITULO', 'CONTENIDO', 'COMPARTIDO');
            new NOTAS_SHOWALL($lista, $datos,$datos2);
        }
    ?>
