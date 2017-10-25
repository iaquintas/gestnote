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
    include '../View/NOTAS_SHOWCURRENT_View.php';
    include '../View/MESSAGE_View.php';

    //funcion que recoge los datos de las vistas
    function get_data_form(){
        $AUTOR = $_REQUEST['AUTOR'];
        $FECHA = $_REQUEST['FECHA'];
        $CONTENIDO = $_REQUEST['CONTENIDO'];
        $COMPARTIDO = $_REQUEST['COMPARTIDO'];
        $NOTAS = new NOTAS_Model($AUTOR,$FECHA,$CONTENIDO,$COMPARTIDO);
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
                $NOTAS = get_data_form();
                $respuesta = $NOTAS->ADD();
                new MESSAGE($respuesta, '../Controller/NOTAS_Controller.php');
            }
            break;
        //Realiza un borrado
        case 'DELETE':
            if (!$_POST){
                $NOTAS = new NOTAS_Model($_REQUEST['AUTOR'],'','','');
                $valores= $NOTAS->RellenaDatos($_REQUEST['AUTOR']);
                new NOTAS_DELETE($valores);
            }else{
                $NOTAS = get_data_form();
                $respuesta = $NOTAS->DELETE();
                new MESSAGE($respuesta, '../Controller/NOTAS_Controller.php');
            }
            break;
        //Edita los datos que quiera el usuario
        case 'EDIT':
            if (!$_POST){
                $NOTAS = new NOTAS_Model($_REQUEST['AUTOR'],'','','');
                $valores= $NOTAS->RellenaDatos($_REQUEST['AUTOR']);
                new NOTAS_EDIT($valores);
            }else{
                $NOTAS = get_data_form();
                $respuesta = $NOTAS->EDIT();
                new MESSAGE($respuesta, '../Controller/NOTAS_Controller.php');
            }
            break;
        //Busca la entidad deseada
        case 'SEARCH':
            if (!$_POST){
                new NOTAS_SEARCH();
            }else{
                $NOTAS = get_data_form();
                $datos = $NOTAS->SEARCH();
                $lista = array( 'AUTOR', 'FECHA', 'CONTENIDO', 'COMPARTIDO');
                new NOTAS_SHOWALL($lista, $datos, '../index.php');
            }
            break;
        //Muestra el/la NOTAS seleccionado
        case 'SHOWCURRENT':
            $NOTAS = new NOTAS_Model($_REQUEST['AUTOR'],'','','');
            $valores= $NOTAS->RellenaDatos($_REQUEST['AUTOR']);
                new NOTAS_SHOWCURRENT($valores);
                break;
        //Opcion por defecto, que muestra todas las instancias de la entidad
        default:
            if (!$_POST){
                $NOTAS = new NOTAS_Model( '', '', '', '');
            }else{
                $NOTAS = get_data_form();
            }
            $datos = $NOTAS->SEARCH();
            $lista = array( 'AUTOR', 'FECHA', 'CONTENIDO', 'COMPARTIDO');
            new NOTAS_SHOWALL($lista, $datos);
        }
    ?>
