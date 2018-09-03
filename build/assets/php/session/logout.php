<?php
    session_start();
    if(isset($_SESSION['username'])){
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        //echo "<center><p style='color:green;'>".'Sesión cerrada exitosamente.'."</p>";
        echo '<script type="text/javascript">
            window.location = "../../../index.php"
        </script>';
    }else{
        //echo "<center><p style='color:red;'>".'No se ha iniciado niguna sesión.'."</p>";
        echo '<script type="text/javascript">
           window.location = "../../../index.php"
        </script>';
    }
?>