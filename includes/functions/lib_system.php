<?php

/**
* Libreria de funciones 
*
* @category   Libreia
* @package    
* @author     Mauricio Santecchia
* @license    Propietary
* @link       
* @see        
* @since      Disponible desde Release 1
* @deprecated 
*/


/*
* @name                    showErrorAndExit
* @description                      Muestra un mensaje y cancela la ejecucion del de programa
* @param       string      $msg     La cadena a mostrar antes de salir
* @param       bool        $params  Arregglo conteniendo los parametros de la cadena. Cada valor va a reemplazar
*                                   dentro de la cadena a las macros %1%,%2%, %3%, ... etc.
* @return      none           		
*/
function showErrorAndExit($msg, $params = array()) {

	foreach ($params as $key => $value) {
		
		$msg = str_replace('%'.$key.'%', $value, $msg);
		
	}

	die($msg);

}

function show_debug($var, $exit = false) {

    echo "<pre>"; 
    print_r($var);
    echo "</pre>"; 
    
    if ($exit) exit;

}

?>