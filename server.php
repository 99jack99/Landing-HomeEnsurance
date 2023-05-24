<?php
	session_start(['name' => 'nueva']);
	define('URL_APP','http://startend-leads.es/leadsapp');
	//Id de la campaña, este ID, es de la aplicación de gestión Demalia
	define('ID_CAMPANA',383);
	//$_SESSION['paso1'] = 0;
	//Gestión si hay id de afiliado
	if(isset($_GET['affID']) && $_GET['affID'] !=''){		
		$_SESSION['affID'] = $_GET['affID'];
	}else{
		if(!isset($_SESSION['affID'])){
			$_SESSION['affID'] = 0;
		}			
	}	
	if(isset($_GET['canal']) && $_GET['canal'] !=''){		
		$_SESSION['canal'] = $_GET['canal'];
	}else{
		if(!isset($_SESSION['canal'])){
			$_SESSION['canal'] = 'EMAIL';
		}			
	}
	if(isset($_GET['key']) && $_GET['key'] !=''){		
		$_SESSION['sub_id_afiliado'] = $_GET['key'];
	}else{
		if(!isset($_SESSION['sub_id_afiliado'])){
			$_SESSION['sub_id_afiliado'] = 0;
		}			
	}
	if(isset($_GET['track']) && $_GET['track'] !=''){		
		$_SESSION['track'] = $_GET['track'];
	}else{
		if(!isset($_SESSION['track'])){
			$_SESSION['track'] = 0;
		}			
	}	
	define('ID_AFILIADOS',$_SESSION['affID']);

	define('CANAL_CAMPANYA',$_SESSION['canal']);

	define('KEY',$_SESSION['sub_id_afiliado']);

	define('CONVERSION',$_SESSION['track']);
	
	//Versión del formulario para estadisticas internas
	define('FORM_SEND',1);
	
	//Ip usuario
	define('IP_USUARIO',$_SERVER['REMOTE_ADDR']);
	
	//session_destroy();
	$array_paginas = array(	'1' => 'index.php',
						   	'2' => 'thanks.php');
	
	//datos a enviar primer función
	/*
	$data = array("id_campana" => entero,
	 			  "id_afiliado" => entero,
	 			  "version_form" => 'lo que quieras'
				  "nombre" => texto,
				  "apellidos" => texto,
				  "email"=> texto,
				  "genero"=> entero 0 chico, 1 chica,
				  "fecha_nacimiento"=> YYYY-MM-DD,
				  "codigo_postal"=> texto,
				  "telefono"=> texto,
				  "aceptacion_condiciones"=> entero,
	 			  "edad"=> entero,
				  "ip" => string,
				  );
 	$id_user = sendUser($data);
	
	*  Devuelve un id de usuario de la aplicación, si devuelve 0 es que no se pudo crear el usuario
	*/
	
	function changeOrderDate($date){
		return implode('-', array_reverse(explode('/', $date)));
	}
	
	function sendUser($data){
		try{
			//url contra la que atacamos
			$ch = curl_init(URL_APP."/index.php?controller=apiController&action=pasoPrimero");
			//a true, obtendremos una respuesta de la url, en otro caso,	
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//establecemos el verbo http que queremos utilizar para la petición
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			//enviamos el array data
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$headers =['Cache-Control: no-cache',
									'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0'];
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			//obtenemos la respuesta
			$response = curl_exec($ch);
			//o el error, por si falla
			$error = curl_error($ch);
			// Se cierra el recurso CURL y se liberan los recursos del sistema
			curl_close($ch);
			
			$response = json_decode($response);			
			
		}catch(Exception $e){
			return 0;
		}  
		if(isset($response->id_user)){
			return $response->id_user;
		}else{
			return 0;	
		} 
		
		return $response->id_user;
	}
	/*
	$data = array("id_campana" => entero,
	 			  "id_usuario" => entero,
	 			  "telefono" => texto,
				  );
 	
	*/
	function sendTelefono($data){
		try{
			//url contra la que atacamos
			$ch = curl_init(URL_APP."/index.php?controller=apiController&action=pasoSegundo");
			//a true, obtendremos una respuesta de la url, en otro caso,	
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//establecemos el verbo http que queremos utilizar para la petición
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			//enviamos el array data
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			//obtenemos la respuesta
			$response = curl_exec($ch);
			//o el error, por si falla
			$error = curl_error($ch);
			// Se cierra el recurso CURL y se liberan los recursos del sistema
			curl_close($ch);
			
			$response = json_decode($response);			
			
		}catch(Exception $e){
			return 0;
		}  
		if(isset($response->guardado)){
			return $response->guardado;
		}else{
			return 0;	
		} 
		
		return $response->guardado;
	}
	/*
	$data = array("id_campana" => ID_CAMPANA,
 			  	  "id_usuario" => $_SESSION['id_usuario'],
 			  	  "id_cliente" => $corregistro['id_corregistro'],
 			  	  "aceptado" => $corregistro['aceptado'],
 			  	  "campo_1" => (isset($corregistro['campo_1']))?$corregistro['campo_1']:'',
 			  	  "campo_2" => (isset($corregistro['campo_2']))?$corregistro['campo_2']:'',
 			  	  "campo_3" => (isset($corregistro['campo_3']))?$corregistro['campo_3']:'',
 			  	  "campo_4" => (isset($corregistro['campo_4']))?$corregistro['campo_4']:'',
 			  	  "campo_5" => (isset($corregistro['campo_5']))?$corregistro['campo_5']:'',
			  );
 	
	*/
	function sendCorregistro($data){
		try{
			//url contra la que atacamos
			$ch = curl_init(URL_APP."/index.php?controller=apiController&action=pasoTercero");
			//a true, obtendremos una respuesta de la url, en otro caso,	
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//establecemos el verbo http que queremos utilizar para la petición
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			//enviamos el array data
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			//obtenemos la respuesta
			$response = curl_exec($ch);
			//o el error, por si falla
			$error = curl_error($ch);
			// Se cierra el recurso CURL y se liberan los recursos del sistema
			curl_close($ch);
			
			$response = json_decode($response);			
			
		}catch(Exception $e){
			return 0;
		}  
		if(isset($response->guardado)){
			return $response->guardado;
		}else{
			return 0;	
		} 
		
		return $response->guardado;
	}
	
	function sendContador($data){
		try{
			//url contra la que atacamos
			$ch = curl_init(URL_APP."/index.php?controller=contadorController&action=contadorCampana");
			//a true, obtendremos una respuesta de la url, en otro caso,	
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//establecemos el verbo http que queremos utilizar para la petición
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			//enviamos el array data
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$headers =['Cache-Control: no-cache',
									'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0'];
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			//obtenemos la respuesta
			$response = curl_exec($ch);
			//o el error, por si falla
			$error = curl_error($ch);
			// Se cierra el recurso CURL y se liberan los recursos del sistema
			curl_close($ch);
			//echo $response;
			
			$response = json_decode($response);			
			
		}catch(Exception $e){
			return 1;
		}  
		if(isset($response->mostrarPixel)){
			return $response->mostrarPixel;
		}else{
			return 1;	
		} 
	}
	function categoria($personalizado1, $IDsAdmitidos){
		//Comprobar si existen códigos postales
		$existe_ids = strpos($IDsAdmitidos, ';');
		if($existe_ids === false){
			//No existen por lo tanto el código postal pasado en función no es válido
			return false;	
		}else{
			$codigo_a_comprobar = $personalizado1;
			
			//Arrya codigos admitidos
			$array_codigos = explode(';',$IDsAdmitidos);
			$array_codigos = array_filter($array_codigos, "strlen"); //Elimina campos vacíos
			foreach($array_codigos as $codigo_){
				if($codigo_a_comprobar == $codigo_){
					return true;
				}
			}
			return false;		
		}	
		
	}

	function existeCodigoPostalValidoEspana($codigo_postal, $codigosAdmitidos){
		//Comprobar si existen códigos postales
		$existe_codigos = strpos($codigosAdmitidos, ';');
		if($existe_codigos === false){
			//No existen por lo tanto el código postal pasado en función no es válido
			return false;	
		}else{
			//El codigo postal pasado tiene más de 2 carácteres ¿?
			if(strlen($codigo_postal ) <= 2){
				$codigo_a_comprobar = (int)$codigo_postal;
			}else{
				//Extraer los dos primeros números del código postal
				$codigo_a_comprobar = substr($codigo_postal, 0, 2); 
			}
			//Arrya codigos admitidos
			$array_codigos = explode(';',$codigosAdmitidos);
			$array_codigos = array_filter($array_codigos, "strlen"); //Elimina campos vacíos
			foreach($array_codigos as $codigo_){
				if($codigo_a_comprobar == (int)$codigo_){
					return true;
				}
			}
			return false;		
		}	
		
	}

	function existeCodigoPostalValidoEspanaEntero($codigo_postal, $codigosAdmitidos){
		//Comprobar si existen códigos postales
		$existe_codigos = strpos($codigosAdmitidos, ';');
		if($existe_codigos === false){
			//No existen por lo tanto el código postal pasado en función no es válido
			return false;	
		}else{
			//El codigo postal pasado tiene más de 2 carácteres ¿?
			if(strlen($codigo_postal ) == 5){
				$codigo_a_comprobar = (int)$codigo_postal;
			}
			//Arrya codigos admitidos
			$array_codigos = explode(';',$codigosAdmitidos);
			$array_codigos = array_filter($array_codigos, "strlen"); //Elimina campos vacíos
			foreach($array_codigos as $codigo_){
				if($codigo_a_comprobar == (int)$codigo_){
					return true;
				}
			}
			return false;		
		}	
		
	}

	function formatearNombre($x)
	{	
		$x = str_replace("-", "", $x);
	    $x = str_replace("", "", $x);
	    $x = str_replace("ñ", "n", $x);
	    $x = str_replace("Ñ", "N", $x);
	    $x = str_replace("Á", "a", $x);
	    $x = str_replace("À", "a", $x);
	    $x = str_replace("É", "e", $x);
	    $x = str_replace("È", "e", $x);
	    $x = str_replace("Í", "i", $x);
	    $x = str_replace("Ì", "i", $x);
	    $x = str_replace("Ó", "o", $x);
	    $x = str_replace("Ò", "o", $x);
	    $x = str_replace("Ú", "u", $x);
	    $x = str_replace("Ù", "u", $x);
	    $x = str_replace("á", "a", $x);
	    $x = str_replace("à", "a", $x);
	    $x = str_replace("é", "e", $x);
	    $x = str_replace("è", "e", $x);
	    $x = str_replace("í", "i", $x);
	    $x = str_replace("ì", "i", $x);
	    $x = str_replace("ó", "o", $x);
	    $x = str_replace("ò", "o", $x);
	    $x = str_replace("ú", "u", $x);
	    $x = str_replace("ù", "u", $x);
	    $x = str_replace("!", "", $x);
	    $x = str_replace("¡", "", $x);
	    $x = str_replace("?", "", $x);
	    $x = str_replace("¿", "", $x); 
		$x = str_replace(",", "", $x);    
		$x = str_replace("º", "", $x);    
		$x = str_replace("ª", "", $x);    
	    
		//conversion de cirilico a latin
		$x = str_replace("Б", "B", $x); $x = str_replace("Г", "G", $x);
		$x = str_replace("Д", "D", $x); $x = str_replace("Ж", "Zh", $x);
		$x = str_replace("З", "Z", $x); $x = str_replace("И", "I", $x);
		$x = str_replace("Й", "J", $x); $x = str_replace("К", "K", $x);
		$x = str_replace("Л", "L", $x); $x = str_replace("П", "P", $x);
		$x = str_replace("У", "U", $x); $x = str_replace("Ф", "F", $x);
		$x = str_replace("Ц", "C", $x); $x = str_replace("Ч", "Ch", $x);
		$x = str_replace("Ш", "Sh", $x); $x = str_replace("Щ", "Sht", $x);
		$x = str_replace("Ъ", "Y", $x); $x = str_replace("Ь", "J", $x);
		$x = str_replace("Ю", "Ju", $x); $x = str_replace("Я", "Ja", $x);
		$x = str_replace("б", "b", $x); $x = str_replace("в", "v", $x);
		$x = str_replace("г", "g", $x); $x = str_replace("д", "d", $x);
		$x = str_replace("ж", "zh", $x); $x = str_replace("з", "z", $x);
		$x = str_replace("и", "i", $x); $x = str_replace("й", "j", $x);
		$x = str_replace("к", "k", $x); $x = str_replace("л", "l", $x);
		$x = str_replace("м", "m", $x); $x = str_replace("н", "n", $x);
		$x = str_replace("п", "p", $x); $x = str_replace("т", "t", $x);
		$x = str_replace("у", "u", $x); $x = str_replace("ф", "f", $x);
		$x = str_replace("ц", "c", $x); $x = str_replace("ч", "ch", $x);
		$x = str_replace("ш", "sh", $x); $x = str_replace("щ", "sht", $x);
		$x = str_replace("ъ", "y", $x); $x = str_replace("ь", "j", $x);
		$x = str_replace("ю", "ju", $x); $x = str_replace("я", "ja", $x);
		$x = str_replace("е", "e", $x); $x = str_replace("О", "o", $x);
		$x = str_replace("М", "m", $x); $x = str_replace("а", "a", $x);
		$x = str_replace("х", "h", $x); $x = str_replace("с", "s", $x);
		$x = str_replace("р", "r", $x); $x = str_replace("о", "o", $x);
		$x = str_replace("С", "S", $x); $x = str_replace("Т", "T", $x);
		$x = str_replace("Е", "E", $x); $x = str_replace("Н", "N", $x);
		$x = str_replace("Х", "x", $x); $x = str_replace("А", "a", $x);
		$x = str_replace("ы", "b", $x); 
		//fin de la conversion 
		 
	    $x = strtolower($x);    
	        
	    return $x;
	}
	define('PIXEL_FACEBOOK_TOKEN', 'EAAJ7u9WtMJQBAOdURNJbbZBNboxZC4cuFE8O3QUSbuDdkDeLQy69h3UL98VSvOZA48qInhlAbiEK6vzLqqf5jHTE2rtpm2ZAfJob1eZCaTtIJkcxXKuQlLJfxOZBV2trw0QatIRfyVZC4ErxBdbx8XfT9IVKElZBzUIysYpZBSwC4ZAx1eZCEDtkag4OjexnWcmqRAZD');
	define('PIXEL_FACEBOOK_ADS_ID', '1602073256631158');
	if(!isset($_SESSION['PIXEL_FACEBOOK_EVENT_ID'])){
			define('PIXEL_FACEBOOK_EVENT_ID', $_SESSION['PIXEL_FACEBOOK_EVENT_ID']);
		}else{
			$event_id = 'evento_finalizado_'.time();
			$_SESSION['PIXEL_FACEBOOK_EVENT_ID'] = $event_id;
			define('PIXEL_FACEBOOK_EVENT_ID', $event_id);
		}
	require('pixel_facebook.php');
?>