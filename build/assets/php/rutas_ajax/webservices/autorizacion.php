<?php
    $direccion = $_GET["direccion"];
    $autorizacion = $_GET["autorizacion"];
    $tarjeta = $_GET["tarjeta"];
    $nombre = $_GET["nombre"]; 
    $fecha = $_GET["fecha_venc"];       
    $num_seguridad = $_GET["num_seguridad"];  
    $formato = $_GET["formato"]; 
    $monto = $_GET["monto"];
    $nombre = urlencode($nombre);
	$url = "http://".$direccion."/".$autorizacion."?tarjeta=".$tarjeta."&nombre=$nombre&fecha_venc=".$fecha."&num_seguridad=".$num_seguridad."&monto=".$monto."&formato=".$formato."&tienda=krasters";
	$respuesta = file_get_contents($url);
	// echo $url;
	echo $respuesta;


	// $tarjeta = $_GET["tarjeta"];

	// $formato = "XML";

	// $numm = rand(1, 50);
	// $numero = rand(1111, 9999);
	// $xml = "<autorizacion>\n";
	// $json = "{\"autorizacion\" :\n";
	// $xml = $xml . "\t<emisor>Visa</emisor>\n";
	// $json = $json . "\t{\"emisor\" : \"Visa\" ,\n";
	// $xml = $xml . "\t<tarjeta>" . $tarjeta . "</tarjeta>\n";
	// $json = $json . "\t \"tarjeta\" : \"". $tarjeta ."\" ,\n";
	// if($numm % 2 != 0){
	// 	$xml = $xml . "\t<status>DENEGADO</status>\n";
	// 	$xml = $xml . "\t<numero>0</numero>\n";
	// 	$json = $json . "\t \"status\" : \"DENEGADO\" ,\n\t \"numero\" : \"0\"\n\t}\n}";
	// }else{
	// 	$xml = $xml . "\t<status>APROBADO</status>\n";
	// 	$xml = $xml . "\t<numero>".$numero."</numero>\n";
	// 	$json = $json . "\t \"status\" : \"APROBADO\" ,\n\t \"numero\" : \"".$numero."\"\n\t}\n}";
	// }
	// $xml = $xml . "</autorizacion>";
	// if($formato == "XML"){
	// 	echo $xml;
	// }else{
	// 	echo $json;
	// }

    
?>

