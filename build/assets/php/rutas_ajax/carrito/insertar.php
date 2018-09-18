<?php
    session_start();
    $producto = $_GET["producto"];
    $color = $_GET["color"];
    $talla = $_GET["talla"];
    $usuario = $_SESSION['username']; //variable que se obtiene con la cookie
    $link = pg_connect("host=localhost dbname=TIENDA user=normal_user password=%normalNormal2018%");
    $query = "SELECT producto_id FROM Carrito AS C WHERE C.usuario='$usuario' AND C.producto_id=$producto AND C.talla='$talla' AND C.color_nombre='$color'";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $resultado = pg_num_rows($result);  
        if($resultado > 0){
            //actualizamos uno mas
            $query = "UPDATE Carrito As C SET cantidad = C.cantidad + 1 WHERE C.producto_id=$producto AND C.talla='$talla' AND C.color_nombre='$color'";                
            $result = pg_query($link, $query);            
            if($result)$retorno = 0;
        }else{
            //insertamos por primera vez          
            $query = "INSERT INTO Carrito(usuario,producto_id,color_nombre,talla,cantidad) VALUES('$usuario','$producto','$color','$talla',1)";
            $result = pg_query($link, $query);
            if($result)$retorno = 1;
        }
    }  
    pg_close($link);
    echo $retorno;    
?>  