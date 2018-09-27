<?php
    $descuento = $_GET["codigo"];
    
    //VERIFICAMOS SI EXISTE Y ESTA DISPONIBLE EL DESCUENTO
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "SELECT * FROM Codigos WHERE codigo=$descuento AND habilitado=1";
    $result = pg_query($link, $query);
    $validCode = pg_num_rows($result);
    echo $validCode;
?>