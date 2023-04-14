<?php


function IP_valida($value){
    if (substr_count($value, '.') != 3){
        return false;
    }

    $octeto = explode('.', $value);

    if (!(is_numeric($octeto[0]) and $octeto[0] >= 0 and $octeto[0] <= 255)){
        return false;
    }

    if (!(is_numeric($octeto[1]) and $octeto[1] >= 0 and $octeto[1] <= 255)){
        return false;
    }

    if (!(is_numeric($octeto[2]) and $octeto[2] >= 0 and $octeto[2] <= 255)){
        return false;
    }

    if (!(is_numeric($octeto[3]) and $octeto[3] >= 0 and $octeto[3] <= 255)){
        return false;
    }

    return true;


}


function MacAddress_valida($value){
        //input = $value = Mac Address
        //output = TRUE or FALSE

        if(preg_match("/([a-f0-9]{2}){6}/",$value)){
            return true;
        }else{
            return false;
        }
}


/*
 * @name                     join_elementos()
 * @description                              Genera una cadena con lo elementos de $arreglo separados por $separador, DESECHA LOS ELEMENTOS VACIOS DEL ARREGLO
 * @param       string       $separador      separador de las partes del arreglo
 * @return      array        $arreglo        arreglo con los datos a unir
 */

function join_elementos($separador,$arreglo) {
	$resultado = '';
	foreach ($arreglo as $elemento) {
		if ($resultado != '' and $elemento != '' and !is_null($elemento) ) {
			$resultado = $resultado . $separador . $elemento;
		} else {
			$resultado = $resultado . $elemento;
		}
	}
	return $resultado;
}



function redirect($url) {
    header('Location: ' . $url);
}

function getMsg($msg, $params = array()) {
	foreach ($params as $key => $value) {
		$msg = str_replace('%'.$key.'%', $value, $msg);
	}
	return $msg;
}

function showMsg($msg, $params = array()) {
	foreach ($params as $key => $value) {
		$msg = str_replace('%'.$key.'%', $value, $msg);
	}
	echo $msg;
}

function convertToSeconds($every) {
    $every = str_replace("y", "*360d+0", $every);
    $every = str_replace("o", "*30d+0", $every);
    $every = str_replace("w", "*7d+0", $every);
    $every = str_replace("d", "*24h+0", $every);
    $every = str_replace("h", "*60m+0", $every);
    $every = str_replace("m", "*60+0", $every);
    return eval('return '.$every.';');
}


function vectorArrayToNameValue($array, $key_name, $value_name){
    $out = array();
    $cont = 0;
    foreach($array as $key => $value) {
        $out[$cont][$key_name] = $key;
        $out[$cont][$value_name] = $value;
        $cont++;
    }
    return $out;
}

function toVectorArray($array, $field_index, $field_value) {
	$out = array();
	foreach ($array as $value) {
		$out[$value[$field_index]] = $value[$field_value];
	}
	return $out;
}


/*
 * @name                     randomString()
 * @description                              Genera cadenas de texto aleatorias
 * @param       int          $length = 10    El numero de caracteres que deseamos que aparezcan en nuestra cadena. 10 por defecto.
 * @param       int          $uc = TRUE      ($uppercase) si deseamos incluir caracteres en mayuscula en la cadena. True por defecto.
 * @param       int          $n = TRUE       (Numeros) si deseamos incluir caracteres numericos. True por defecto.
 * @param       int          $sc = FALSE     (Special Chars) finalmente si deseamos incluir caracteres especiales, False por defecto.
 * @return      string                       Una cadena de de caracteres aleatoria, puede tener numeros, etc.
 */
function randomString($length = 10, $uc = TRUE, $n = TRUE, $sc = FALSE) {

    $source = 'abcdefghijklmnopqrstuvwxyz';
    if($uc == 1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if($n == 1)  $source .= '1234567890';
    if($sc == 1) $source .= '|@#~$%()=^*+[]{}-_';

    if($length>0) {
        $rstr = '';
        //$source = str_split($source,1);
        $source = preg_split( '/|/', $source);
        for($i=1; $i<=$length; $i++) {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1, count($source));
            $rstr .= $source[$num -  1];
        }
    }

    return $rstr;

}

/*
 * @name                     tipoArchivo()
 * @description                             Retorna la extension del arhivo pasado como parametro
 * @param       string       $archivo       Nombre de archivo (ej. archivo.txt)
 * @return      string                      String con la extension del archivo (txt)
 */
function tipoArchivo($archivo) {
    $partes = split("\.", $archivo);
    $extension = $partes[count($partes) - 1];
    return $extension;
}

/*
 * @name                     uploadResizeImage()
 * @description                             Descarga, Redimensiona y convierte una imagen al formato jpg
 * @param       string       $field_name    campo de imagen del html de tipo file que se quiere descargar
 * @param       string       $file_name     nombre (y path) del archivo destino de la imagen
 * @param       integer      $height        alto final de la imagen (opcional)
 * @param       integer      $width         ancho final de la imagen (opcional)
 * @param       boolean      $image_ratio   indica si se conservara la relacion de aspecto de la imagen (opcional)
 * @return      boolean                     true si se subio y redimensiono exitosamente, false si no
 */
function uploadResizeImage($field_name, $file_name, $height = 0, $width = 0, $image_ratio = true) {
    // sube la imagen al servidor
    $handle = new upload($_FILES[$field_name]);
    if ($handle->uploaded) {

        $path = dirname($file_name) . "/";
        $temp_name = randomString(20);
        $handle->file_new_name_body   = $temp_name;

        // redimensiona la imagen
     	$handle->image_resize         = true;
		$handle->file_overwrite       = true;
      	$handle->image_convert        = 'jpg';
		if ($width and $height){
			$handle->image_y          = $height;
			$handle->image_x          = $width;
            $handle->image_ratio      = $image_ratio;
		}elseif ($height){
			$handle->image_y          = $height;
      		$handle->image_ratio_x    = true;
		}elseif($width){
			$handle->image_x          = $width;
      		$handle->image_ratio_y    = true;
		}else{
            $handle->image_resize     = false;
        }

		$handle->process($path);
        $handle->clean();
        if ($handle->processed) {
            rename($path . $temp_name . ".jpg", $file_name);
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function encode_utf8(&$arreglo) {
    foreach ($arreglo as $key => $value) {
        $arreglo[$key] = utf8_encode($arreglo[$key]);
    }
}

function _addArray($cads, $d0, $h0, $d1, $h1) {

    foreach ($cads as $v) {

        $arr = split("\.", $v);

        if ($arr[sizeof($arr)-1] < $h0) {

            if ($arr[sizeof($arr)-1] == $d0) { $init = $d1; } else { $init = 1; }

            for ($i = $init; $i <= 254; $i++) {

                $r[] = "$v.$i";

            }

        } else {

            if ($d0 < $h0) $d1 = 1;

            for ($i = $d1; $i <= $h1; $i++) {

                $r[] = "$v.$i";

            }

        }

    }

    return $r;

}

function ipToArray($desde_ip, $hasta_ip) {

    $desde = split("\.", $desde_ip);
    $hasta = split("\.", $hasta_ip);

    for ($i = $desde[0]; $i <= $hasta[0]; $i++) $initArray[] = $i;

    $ipArray = _addArray(
                        _addArray(
                                 _addArray(
                                          $initArray,
                                          $desde[0], $hasta[0], $desde[1], $hasta[1]
                                 ),
                                 $desde[1], $hasta[1], $desde[2], $hasta[2]
                        ),
                        $desde[2], $hasta[2], $desde[3], $hasta[3]
               );

    return $ipArray;

}

/*
 * @name                     listar_archivos()
 * @description                             retorna en un arreglo lo nombres de archivos de un directorio
 * @param       string       $dir           directorio del que se quieren obtener los nombres de archivos
 * @param       string       $filtro        expresion regular que indica que archivos se buscan
 * @return      array                       arreglo con los nombres de archivos encontrados que concuerdan con el filtro
 */
function listar_archivos($dir,$filtro) {
    $retorno = array();
    $files = dir($dir);
    while (false !== ($file = $files->read())) {
        if (ereg($filtro, $file)) {
            $retorno[] = $file;
        }
    }
    $files->close();
    return $retorno;
}

function separarMacConDosPuntos($mac){
	return eregi_replace  ( "([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})",
                            "\\1:\\2:\\3:\\4:\\5:\\6", $mac);
}

function encriptar($pass) {
    return crypt($pass);
}

function setABN($id_abn,$valor,$prioridad = 0, $tarea = '', $reversible = false){

	if (updateDb(array('flag'=>$valor), 'id = ' . $id_abn, 'sys_abns', $reversible)) {
	    if ($tarea != ''){
    	    if (insertDb(array('id_abn'=>$id_abn,
                               'prioridad'=>$prioridad,
                               'tarea'=>$tarea),
                        'sys_abns_tareas', $reversible)) {
                return true;
    	    } else {
    	        return false;
    	    }
	    }
        return true;
    }else{
        return false;
    }
}

function clearTaskABN($id_tarea){
	if (q("DELETE
             FROM sys_abns_tareas
            WHERE id = " . $id_tarea,false)) {
        return true;
    }else{
        return false;
    }
}

// funcion que elimina los logs viejos de un abn
function cleanLogsABN($id_abn,$duracion_log) {
    if (q("DELETE
             FROM sys_abns_logs
            WHERE ((EXTRACT(EPOCH FROM now()) - EXTRACT(EPOCH FROM hora)) / 60) > $duracion_log AND
                  id_abn = $id_abn;",false)) {
        return true;
    } else {
        return false;
    }
}

// funcion que guarda un mensaje de log de un abn
function logABN($id_abn,$tipo_mensaje,$mensaje, $echo = false){

    if ($echo) echo "$mensaje\n";
    
	if (insertDb(array('id_abn'=>$id_abn, 'tipo_mensaje'=>$tipo_mensaje, 'mensaje'=>$mensaje),
                 'sys_abns_logs')) {
        return true;
    } else {
        return false;
    }
    
}


function incluir($archivo) {

//    ob_start();
    include_once($archivo);
//    $result = ob_get_contents();
//    ob_end_clean();

}



function encode_json($value) {
    $parser_version = phpversion();

    // segun la version de php en el servidor usa el json nativo o la clase
    if ($parser_version < "5.2.0") {
        global $json;
        return $json->encode($value);
    } else {
        return json_encode($value);
    }
}


function decode_json($value) {
    $parser_version = phpversion();

    // segun la version de php en el servidor usa el json nativo o la clase
    if ($parser_version < "5.2.0") {
        global $json;
        return $json->decode($value);
    } else {
        return json_decode($value,true);
    }
}


function obtener_id_cliente($id_locacion_cliente = '', $id_locacion_cliente_pack = '', $id_locacion_cliente_pack_servicio = '') {

    if ($id_locacion_cliente != '') {
        $sql = "SELECT lc.id_cliente
                  FROM com_locaciones_clientes AS lc
                 WHERE lc.id = " . $id_locacion_cliente;
    } elseif ($id_locacion_cliente_pack != '') {
        $sql = "SELECT lc.id_cliente
                  FROM com_locaciones_clientes_packs AS lcp
                       JOIN com_locaciones_clientes AS lc ON lc.id = lcp.id_locacion_cliente
                 WHERE lcp.id = " . $id_locacion_cliente_pack;
    } elseif ($id_locacion_cliente_pack_servicio != '') {
        $sql = "SELECT lc.id_cliente
                  FROM com_locaciones_clientes_packs_servicios AS lcps
                       JOIN com_locaciones_clientes_packs AS lcp ON lcp.id = lcps.id_locacion_cliente_pack
                       JOIN com_locaciones_clientes AS lc ON lc.id = lcp.id_locacion_cliente
                 WHERE lcps.id = " . $id_locacion_cliente_pack_servicio;
    } else {
        return -1;
    }
    $consulta = q($sql,true);

    if ($consulta and $consulta[0]['id_cliente'] > 0) {
        return $consulta[0]['id_cliente'];
    } else {
        return -1;
    }

}


/*     '[
            {
                "id_request":"1",
                "id_transaction":-1,
                "errors":{
                            "code":9,
                            "property":"request",
                            "message":"webservice inactive."
                         },
                "result_ok":false
            }
         ]';*/

function indentJsonString($data, $formato = 'plano') {

    $corchete_abre = "[";
    $corchete_cierra = "]";
    $llave_abre = "{";
    $llave_cierra = "}";
    $separador_elementos = ",";
    $separador_key = '":';
    $salto = "\n";

    if ($formato == 'table') {
        $separador = "";
        $corchete_abre = "<table><tr><td>";
        $corchete_cierra = "</td></tr></table>";
        $llave_abre = "<table border=1 cellspacing=0 cellpadding=0><tr><td>";
        $llave_cierra = "</td></tr></table>";
        $separador_elementos = "</td></tr><tr><td width=100%>";
        $separador_key = '"</td><td>';

    } elseif ($formato == 'html') {
        $separador = "&nbsp;";
        $salto = "<br/>";
    } else {
        $separador = " ";
    }

    $data = str_replace("\\", "" , $data);
    $data = str_replace('\"', '"' , $data);

    $data = str_replace("{", $llave_abre . $salto , $data);
    $data = str_replace("}", $salto . $llave_cierra . $salto, $data);
    $data = str_replace("[", $corchete_abre . $salto, $data);
    $data = str_replace("]", $salto . $corchete_cierra . $salto, $data);
    $data = str_replace(",", $separador_elementos . $salto, $data);
    $data = str_replace('":', $separador_key, $data);

    $a_data = explode($salto, $data);

    $level = 0;
    $datafinal = '';

    foreach ($a_data as $line) {
        
        if ($line == $separador_elementos) {
            $datafinal .= $line . $salto;
        } elseif (strstr($line, $llave_abre) or strstr($line, $corchete_abre)) {
            $datafinal .= str_repeat($separador, $level*4) . $line . $salto;
            $level++;
        } elseif (strstr($line, $llave_cierra) or strstr($line, $corchete_cierra)) {
            $level--;
            $datafinal .= str_repeat($separador, $level*4) . $line ;
        } elseif ($line != '') {
            $datafinal .= str_repeat($separador, $level*4) . $line . $salto;
        } else {
            $datafinal .= $salto;
        }
    }


    return $datafinal;

}

function is_defined($val) {

    return isset($val) and $val != "";

}

function generate_password ($length = 8) {

    // start with a blank password
    $password = "";

    // define possible characters
    $possible = "0123456789bcdfghjkmnpqrstvwxyz";

    // set up a counter
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

        // we don't want this character if it's already in the password
        if (!strstr($password, $char)) {

            $password .= $char;
            $i++;

        }

    }

    // done!
    return $password;

}

function quitar_acentos($str) {

    $letras_malas = array("á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ");
    $letras_buenas = array("a", "e", "i", "o", "u", "n", "A", "E", "I", "O", "U", "N");

    return str_replace($letras_malas, $letras_buenas, $str);  

}

function get_last_item() {

    $q_last = q("select max(id) as last from lotes where estado = 1 and cantidad > 0 and  id_imagen_principal is not null");

    return $q_last[0]['last'];

}

?>