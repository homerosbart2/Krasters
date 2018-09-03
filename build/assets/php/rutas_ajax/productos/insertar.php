<?php
    //encargado de crear la sesion del usuario y ver que si se haya creado una sesion
    $nombre = $_GET["nombre"];
    $descripcion = $_GET["descripcion"];
    $precio = $_GET["precio"];
    $talla = $_GET["talla"];
    $cantidad = $_GET["cantidad"];
    $color = $_GET["color"];
    $marca = $_GET["marca"];        
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "INSERT INTO Productos(producto_nombre,descripcion,precio,marca_nombre) VALUES('$nombre','$descripcion',$precio,'$marca') RETURNING producto_id";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $row = pg_fetch_assoc($result);
        $producto = $row["producto_id"];
        $query = "INSERT INTO Existencias(producto_id,talla,existencia,color_nombre) VALUES($producto,'$talla',$cantidad,'$color')";        
        $result = pg_query($link, $query);
        if($result){
            $retorno = $producto;
        }
    }  
    pg_close($link);
    echo $retorno;
?>