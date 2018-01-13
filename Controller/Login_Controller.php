<?php

  include '../Model/Access_DB.php';
    //Controlador del login
    session_start();
    if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
    	include '../View/Login_View.php';

    	$login = new Login();
    }
    else{

    	 ConnectDB();

    	 Login($login, $password);



    	$respuesta = Login($_REQUEST['login'], $_REQUEST['password']);

    	if ($respuesta == 'true'){
    		session_start();
    		$_SESSION['login'] = $_REQUEST['login'];
    		header('Location:../index.php');
    	}
    	else{
    		include '../View/MESSAGE_View.php';
    		new MESSAGE($respuesta, '../Controller/Login_Controller.php');
    	}



    }

    ?>
