<?php

	include('server.php');
	//Recolectar datos formulario	

	//Nombre
	$nombre = '';
	if(isset($_POST['nombre'])){
		$nombre = formatearNombre($_POST['nombre']);
		$_SESSION['nombre'] = $nombre;
	}

    //apellidos
	$apellidos = '';
	if(isset($_POST['apellidos'])){
		$apellidos = formatearNombre($_POST['apellidos']);
		$_SESSION['apellidos'] = $apellidos;
	}
	
	//email
	$email = '';
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$_SESSION['email'] = $email;
	}

	//Teléfono
	$telefono = '';
	if(isset($_POST['telefono'])){
		$telefono = $_POST['telefono'];
		$_SESSION['telefono'] = $telefono;
	}

	//Código Postal
	$codigo_postal = '';
	if(isset($_POST['codigo_postal'])){
		$codigo_postal = $_POST['codigo_postal'];
		$_SESSION['codigo_postal'] = $codigo_postal;
	}

	//personalizado1 
	$personalizado1 = '';
	if(isset($_POST['personalizado1'])){
		$personalizado1 = $_POST['personalizado1'];
		$_SESSION['personalizado1'] = $personalizado1;
	}

	

	//personalizado10
	$personalizado10 = '';
	if(isset($_POST['personalizado10'])){
		$personalizado10 = $_POST['personalizado10'];
		$_SESSION['personalizado10'] = $personalizado10;
	}

	//termin
	$termin = 0;
	if(isset($_POST['termin'])){
		$termin = (int)$_POST['termin'];
		$_SESSION['termin'] = $termin;
	}

    //otros
	$otros = 0;
	if(isset($_POST['otros'])){
		$otros = (int)$_POST['otros'];
		$_SESSION['otros'] = $otros;
	}

	
	//comprueba que tengo los datos necesarios
	if($nombre != '' && $apellidos != '' && $email != '' && $telefono != '' && $codigo_postal != '' && $personalizado1 != '' && $termin == 1){
		
		//Guardo datos en local
		
		//Guardo datos en servidor
		$data = array("id_campana" => ID_CAMPANA,
			 			"id_afiliado" => ID_AFILIADOS,
			 			"version_form" => FORM_SEND,
			 			"canal" => CANAL_CAMPANYA,
			 			"sub_id_afiliado" => KEY,
			 			"personalizado10" => CONVERSION,
						"nombre"=> $nombre,
                        "apellidos"=> $apellidos,
						"email"=> $email,
					 	"telefono"=> $telefono,
					 	"codigo_postal" => $codigo_postal,
					 	"personalizado1" => $personalizado1,
						"aceptacion_condiciones"=> $termin,
                        "otros"=> $otros,
						"ip" => IP_USUARIO
					  );
					  
		$id_user = sendUser($data);
		
		if($id_user != 0){
			$_SESSION['id_usuario'] = $id_user;	
			//Válido este paso
			$_SESSION['paso1'] = 1;	
			header('Location: '.$array_paginas[2]);
		}
		header('Location: '.$array_paginas[1].'?error=repetido');
	}else{
		//Envía al usuario de nuevo al formulario de datos
		header('Location: '.$array_paginas[1]);	
	}
?>