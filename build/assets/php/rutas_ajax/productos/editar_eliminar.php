<?php
    //encargado de editar o eliminar un producto    
    $accion = $_GET["accion"]; //0 -> actualizar, 1 -> eliminar
    $producto = $_GET["producto"]; 
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $retorno = -1;
    if ($accion == 1) {
        $nombre = $_GET["nombre"];
        $descripcion = $_GET["descripcion"];
        $precio = $_GET["precio"];           
        $query = "UPDATE ProductoS SET producto_nombre = '$nombre',descripcion='$descripcion',precio=$precio WHERE producto_id=$producto";
        $result = pg_query($link, $query);
        if($result) $retorno = 1;
    }else{
        $query = "DELETE FROM Productos WHERE producto_id=$producto"; 
        $result = pg_query($link, $query);
        if($result) $retorno = 0;        
    }  
    pg_close($link);
    echo $retorno;
?>