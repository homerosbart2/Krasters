<?php
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $result_array = array();
    $query = "SELECT * FROM Emisores WHERE nombre='Generador'";
    $result = pg_query($link, $query);
    while($row = pg_fetch_assoc($result)){
        $direccion = $row["direccion_ip"];
        $autorizacion = $row["autorizacion_path"];
        $formato = $row["formato"];
    }
    pg_close($link);
    $url = "http://".$direccion."/".$autorizacion."?";
    // $url = "http://192.168.0.104/tienda/descuento.php";
    $respuesta = file_get_contents($url);
    echo $respuesta;
?>