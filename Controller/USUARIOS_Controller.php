<?php

    //Controller de la entidad: USUARIOS

    session_start();
    include '../Functions/Authentication.php';

	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

    //includes necesarios
    include '../Model/USUARIOS_Model.php';
    include '../View/USUARIOS_SHOWALL_View.php';
    include '../View/USUARIOS_SEARCH_View.php';
    include '../View/USUARIOS_ADD_View.php';
    include '../View/USUARIOS_EDIT_View.php';
    include '../View/USUARIOS_DELETE_View.php';
    include '../View/USUARIOS_SHOWCURRENT_View.php';
    include '../View/MESSAGE_View.php';

    //funcion que recoge los datos de las vistas
    function get_data_form(){
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];
        $USUARIOS = new USUARIOS_Model($login,$password);
        return $USUARIOS;
    }

    if(!isset($_REQUEST['action'])){
        $_REQUEST['action'] = '';
    }

    //switch para las distintas vistas
    Switch ($_REQUEST['action']){
        //Añade un nuevo USUARIOS
        case 'ADD':
            if (!$_POST){
                new USUARIOS_ADD();
            }else{
                $USUARIOS = get_data_form();
                $respuesta = $USUARIOS->ADD();
                new MESSAGE($respuesta, '../Controller/USUARIOS_Controller.php');
            }
            break;
        //Realiza un borrado
        case 'DELETE':
            if (!$_POST){
                $USUARIOS = new USUARIOS_Model($_REQUEST['login'],'');
                $valores= $USUARIOS->RellenaDatos($_REQUEST['login']);
                new USUARIOS_DELETE($valores);
            }else{
                $USUARIOS = get_data_form();
                $respuesta = $USUARIOS->DELETE();
                new MESSAGE($respuesta, '../Controller/USUARIOS_Controller.php');
            }
            break;
        //Edita los datos que quiera el usuario
        case 'EDIT':
            if (!$_POST){
                $USUARIOS = new USUARIOS_Model($_REQUEST['login'],'');
                $valores= $USUARIOS->RellenaDatos($_REQUEST['login']);
                new USUARIOS_EDIT($valores);
            }else{
                $USUARIOS = get_data_form();
                $respuesta = $USUARIOS->EDIT();
                new MESSAGE($respuesta, '../Controller/USUARIOS_Controller.php');
            }
            break;
        //Busca la entidad deseada
        case 'SEARCH':
            if (!$_POST){
                new USUARIOS_SEARCH();
            }else{
                $USUARIOS = get_data_form();
                $datos = $USUARIOS->SEARCH();
                $lista = array( 'login', 'password');
                new USUARIOS_SHOWALL($lista, $datos, '../index.php');
            }
            break;
        //Muestra el/la USUARIOS seleccionado
        case 'SHOWCURRENT':
            $USUARIOS = new USUARIOS_Model($_REQUEST['login'],'');
            $valores= $USUARIOS->RellenaDatos($_REQUEST['login']);
                new USUARIOS_SHOWCURRENT($valores);
                break;
        //Opcion por defecto, que muestra todas las instancias de la entidad
        default:
            if (!$_POST){
                $USUARIOS = new USUARIOS_Model( '', '');
            }else{
                $USUARIOS = get_data_form();
            }
            $datos = $USUARIOS->SEARCH();
            $lista = array( 'login', 'password');
            new USUARIOS_SHOWALL($lista, $datos);
        }
    ?>