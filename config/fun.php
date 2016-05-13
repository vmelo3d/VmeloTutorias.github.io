<?php

function By2M($size){
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}

function limit($string){
	$limite = 38;

	$ext = substr($string, -4);

	if (strlen($string)>$limite) {
		echo substr($string, 0,$limite).'...'.$ext;
	}else{
		echo $string;
	}
}

function limitbusca($string){
	$limite = 30;

	$ext = substr($string, -4);

	if (strlen($string)>$limite) {
		echo substr($string, 0,$limite).'..'.$ext;
	}else{
		echo $string;
	}
}

function aviso($aviso){
	print "<script>alert('".$aviso."')</script>";
}

function consulta($query){

	$sql = $query;
 return mysql_num_rows($sql);
}
function select($table,$where,$wherevalue){
	$qquery = "SELECT * FROM $table WHERE $where = '{$wherevalue}'";

	return mysql_query($qquery);
}

function data($string){
	$ano = substr($string, 0 , -15);
	$mes = substr($string, 5,-12);
	$dia = substr($string, 8,-9);

	echo $dia.'/'.$mes.'/'.$ano;
}

function hora($string){

	$hora = substr($string, 11);

	echo $hora;

}

function titulo($string){
	$string = substr($string, 33);

	echo $string;
}
function limitaTexto( $texto , $tamanho ){
 	return strlen( $texto ) > $tamanho ? substr( $texto , 0 , $tamanho ) : $texto;
}
?>