<?php 
    session_start();
    $usuario = "";
    $role = "";
    if(isset($_SESSION['username'])){
        $usuario_actual = $_SESSION['username']; 
        $role = $_SESSION['role'];
    }else{       
        header("Location: ../../../index.php");                 
    }
?>   