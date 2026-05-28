<?php #if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
* Muestra de mensajes
*	class = error || success
*/
function _print_messages(){
	$CI =& get_instance();
	echo validation_errors('<div class="error">', '</div>');
	$all = $CI->messages->get();
	foreach($all as $type=>$messages)
		foreach($messages as $message)
			echo '<div id="alert-'.$type.'" class="alert alert-'.$type.' fade show"><p align="center">'.$message.'</p></div>';
}

/*
* Genera limpia el string para usarlo como url
*/
function _slug( $str = null ){

	$characters = array(
		 "Á" => "A", "Ç" => "c", "É" => "e", "Í" => "i", "Ñ" => "n", "Ó" => "o", "Ú" => "u",
		 "á" => "a", "ç" => "c", "é" => "e", "í" => "i", "ñ" => "n", "ó" => "o", "ú" => "u",
		 "à" => "a", "è" => "e", "ì" => "i", "ò" => "o", "ù" => "u", "¿" => "", "?" => "" , "," => "",
		 "¡" => "", "!" => "", "'" => "", "%" => "", '"' => ""
	);

	$str = trim(str_replace(' ', '-', $str));
	$str = strtr($str, $characters);

	return strtolower($str);
}


/*
* Envio de mail generico
*/
function _send_mail( $subject = null, $to = null, $body = null ){
	$CI =& get_instance();
	$CI->load->library(array('email'));

	$config = array(
		'mailtype' => 'html',
		'charset'  => 'utf-8',
		'priority' => 1,
		'newline'  => "\r\n"
    );

	$CI->email->initialize($config);

	$CI->email->subject($subject);

	$CI->email->from('informes@movealong.mx', "Movealong");
	$CI->email->to($to);

	$CI->email->message($body);

	return $CI->email->send();
}

/*
Comprueba si una cadena es fecha
 */
function _isDate($str){
	$str   = str_replace('/', '-', $str);
	$stamp = strtotime($str);
	$result = false;
	if (is_numeric($stamp)){

		$month = date( 'm', $stamp );
		$day   = date( 'd', $stamp );
		$year  = date( 'Y', $stamp );

		$result = checkdate($month, $day, $year);
	}
	return $result;
}

function _getNombreMes($month=''){
	$nombre = '';

	switch ($month) {
		case '1':$nombre  = "Enero";break;
		case '2':$nombre  = "Febrero";break;
		case '3':$nombre  = "Marzo";break;
		case '4':$nombre  = "Abril";break;
		case '5':$nombre  = "Mayo";break;
		case '6':$nombre  = "Junio";break;
		case '7':$nombre  = "Julio";break;
		case '8':$nombre  = "Agosto";break;
		case '9':$nombre  = "Septiembre";break;
		case '10':$nombre  = "Octumbre";break;
		case '11':$nombre = "Noviembre";break;
		case '12':$nombre = "Diciembre";break;
		default:$nombre   = 'desconocido';break;
	}
	return $nombre;
}//end getNombreMes function


/*
* Cadena de caracteres aleatorios
*/
function _RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE){
    $source = 'abcdefghijklmnopqrstuvwxyz';
    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if($n==1) $source .= '1234567890';
    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
    if($length>0){
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }

    }
    return $rstr;
}

function cargar_env(string $ruta): void{
        if ( ! file_exists($ruta)) return;

        $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lineas as $linea) {
            if (strpos(trim($linea), '#') === 0) continue;

            [$clave, $valor] = explode('=', $linea, 2);

            $clave = trim($clave);
            $valor = trim($valor);

            if ( ! getenv($clave)) {
                putenv("$clave=$valor");
                $_ENV[$clave]    = $valor;
                $_SERVER[$clave] = $valor;
            }
        }
}