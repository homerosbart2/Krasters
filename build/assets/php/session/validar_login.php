<?php
    //encargado de crear la sesion del usuario y ver que si se haya creado una sesion
    $password = $_GET["password"];
    $username = $_GET["username"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "SELECT * FROM Usuarios As U WHERE U.password_usuario= '$password' AND U.usuario='$username'";
    $result = pg_query($link, $query);
    $resultado = 0;
    $retorno = -1;
    if ($result) {
        $resultado = pg_num_rows($result);
        if($resultado != 0){
            session_start();
            //creamos las variables de sesion
            $row = pg_fetch_assoc($result);
            $_SESSION['username'] = $row["usuario"];
            $_SESSION['role'] = $row["role"];
            $retorno = $row["role"];
        }
    }  
    pg_close($link);
    echo $retorno;
?>