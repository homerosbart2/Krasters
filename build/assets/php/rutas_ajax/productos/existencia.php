<?php
    //encargado de retornar los productos
    $producto = $_GET["producto"]; 
    $talla = $_GET["talla"]; 
    $color = $_GET["color"];     
    $retorno = -2;
    $link = pg_connect("host=localhost dbname=TIENDA user=normal_user password=%normalNormal2018%");
    $query = "SELECT E.existencia FROM Existencias AS E WHERE (E.color_nombre = '$color') AND (E.talla = '$talla') AND (E.producto_id = $producto)";        
    $result = pg_query($link, $query); 
    $i = 0;
    if($result){
        if(pg_num_rows($result) > 0){
            $row = pg_fetch_assoc($result);
            $retorno = $row["existencia"];
        }else{
            $retorno = -1;
        }
    }
    pg_close($link);
    echo $retorno;
?>