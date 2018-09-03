<?php
    $nombre = $_GET["nombre"];
    $direccion = $_GET["direccion"];
    $envio = $_GET["envio"];
    $estado = $_GET["estado"];
    $consulta = $_GET["consulta"];
    $formato = $_GET["formato"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "INSERT INTO Couriers(nombre,direccion_ip,estado_path,consulta_path,envio_path,formato) VALUES('$nombre','$direccion','$estado','$consulta','$envio','$formato')";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 0;
    }  
    pg_close($link);
    echo $retorno;    
?>