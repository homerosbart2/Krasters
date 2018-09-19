<?php 
    include '../session/islogedin.php';
    $usuario = $_SESSION['username']; //variable cookie
?>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="../../js/jquery.min.js" type="text/javascript"></script>
    <script src="../../js/pnotify.custom.min.js" type="text/javascript"></script>
    <link href="../../css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../css/bootstrap.css" media="all" rel="stylesheet" type="text/css" />    
    <link rel="stylesheet" href="../../css/main.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  </head>
  <body>
      <section id="header">
        <nav>
            <ul class="main-nav">
                <span class="logo-division">
                    <li><a href="" class="nav-logo"><b>KRAS</b>TERS</a></li>
                </span>
                <span class="options-division">
                    <?php 
                        if($role == 1){
                            $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                            $query = "SELECT count(*) AS compras FROM Carrito WHERE usuario='$usuario' AND cantidad > 0";
                            $result = pg_query($link, $query); 
                            $row = pg_fetch_assoc($result);
                            $resultado = $row["compras"];
                            echo '<li class="nav-user"><a href=""><b>usuario: </b> '. $usuario.'</a></li>';
                            //<!-- En el span .counter se debe colocar el tamaño del detalle. -->
                            echo '<li><a href="../shop/home.php" class="nav-option"><span class="option-icon"><i class="fas fa-shopping-bag"></i></span><span class="option-label">Tienda</span></a></li>';     
                            echo '<li><a href="../ordenes/ver_ordenes.php" class="nav-option"><span class="option-icon"><i class="fas fa-box-open"></i></span><span class="option-label">Órdenes</span></a></li>';
                            if($resultado != 0) echo '<li><a href="../shop/shopping_cart.php" class="nav-option"><span class="option-icon"><i class="fa fa-shopping-cart"></i></span><span class="option-label">Carrito</span><span class="counter">'.$resultado.'</span></a></li>';
                            else echo '<li><a href="../shop/shopping_cart.php" class="nav-option"><span class="option-icon"><i class="fa fa-shopping-cart"></i></span><span class="option-label">Carrito</span><span class=""></span></a></li>';   
                            echo '<li><a href="../session/logout.php" class="nav-option"><span class="option-icon"><i class="fas fa-sign-out-alt"></i></span><span class="option-label">Salir</span></a></li>';
                        }else{
                            $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                            $query = "SELECT count(*) AS compras FROM Carrito WHERE usuario='$usuario' AND cantidad > 0";
                            $result = pg_query($link, $query); 
                            $row = pg_fetch_assoc($result);
                            $resultado = $row["compras"];
                            echo '<li class="nav-user"><a href=""><b>usuario: </b> '. $usuario.'</a></li>';
                            echo '<li><a href="../admin/adminShop.php" class="nav-option"><span class="option-icon"><i class="fas fa-cog"></i></span><span class="option-label"> Administrar</span></a></li>';
                            echo '<li><a href="../admin/adminProviders.php" class="nav-option"><span class="option-icon"><i class="fas fa-people-carry"></i></span><span class="option-label"> Proveedores</span></a></li>';
                            //<!-- En el span .counter se debe colocar el tamaño del detalle. -->
                            echo '<li><a href="../shop/home.php" class="nav-option"><span class="option-icon"><i class="fas fa-shopping-bag"></i></span><span class="option-label">Tienda</span></a></li>';     
                            echo '<li><a href="../ordenes/ver_ordenes.php" class="nav-option"><span class="option-icon"><i class="fas fa-box-open"></i></span><span class="option-label">Órdenes</span></a></li>';
                            if($resultado != 0) echo '<li><a href="../shop/shopping_cart.php" class="nav-option"><span class="option-icon"><i class="fa fa-shopping-cart"></i></span><span class="option-label">Carrito</span><span class="counter">'.$resultado.'</span></a></li>';
                            else echo '<li><a href="../shop/shopping_cart.php" class="nav-option"><span class="option-icon"><i class="fa fa-shopping-cart"></i></span><span class="option-label">Carrito</span><span class=""></span></a></li>';   
                            echo '<li><a href="../session/logout.php" class="nav-option"><span class="option-icon"><i class="fas fa-sign-out-alt"></i></span><span class="option-label">Salir</span></a></li>';
                        }
                    ?>
                </span>
            </ul>
        </nav>
      </section>
     
  </body>
</html>
