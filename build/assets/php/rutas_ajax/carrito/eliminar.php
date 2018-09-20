<?php
    session_start();
    $carrito = $_GET["carrito"];
    $producto = $_GET["producto"];
    $color = $_GET["color"];
    $talla = $_GET["talla"];
    $usuario = $_SESSION['username']; //variable que se obtiene con la cookie
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "UPDATE Carrito AS C SET cantidad = C.cantidad - 1 WHERE C.carrito_id = $carrito AND usuario='$usuario'";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        //actualizamos existencias en uno mas
        //$query = "UPDATE Existencias As E SET existencia = E.existencia + 1 WHERE E.producto_id=$producto AND E.talla='$talla' AND E.color_nombre='$color'";
        //$result = pg_query($link, $query);
        //if($result) 
        $retorno = 0;
    }  
    pg_close($link);
    echo $retorno;    
?>  