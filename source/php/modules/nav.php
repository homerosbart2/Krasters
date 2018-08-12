<?php 
    include '../session/islogedin.php';
    include '../cookies/cookies.php';
    date_default_timezone_set("America/Guatemala");
    $hours = date("h");
    $minutes = date("i");
    $seconds = date("s");
    $part = date("a");
    echo "<form>";
    echo "<input type='hidden' id='hours' value='$hours'>";
    echo "<input type='hidden' id='minutes' value='$minutes'>";
    echo "<input type='hidden' id='seconds' value='$seconds'>";
    echo "<input type='hidden' id='part' value='$part'>";
    echo "</form>";
?>
<html>
  <head>
     <title>
        QUINIELA
     </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
    <link rel="stylesheet" type="text/css" href="../css/ss.css">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Lobster|Roboto+Condensed" rel="stylesheet">  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>       
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
  </head>
  <body>
     <center>
        <nav class="navbar navbar-default" style="position:fixed; top:-3; width:100%; z-index:1000;">
            <div id='pageTitle' class='text-left pageTitle'><font size=6><b>QUINIELA</b></font><font size=4> <span class='title-clock'><i class='fas fa-circle-notch fa-spin'></i></span></font></div>
            <div style='float:right;' class="container-fluid container-full-navbar">
                <div class="navbar-header">
                <a style="cursor: default;" class="navbar-brand"><?php echo '<b>Usuario:</b> '.$usuario; ?></a>
                </div>
                <ul class="nav navbar-nav">
                    <?php 
                        if($role == 0){                                                       
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0); border-left: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../partidos/calendario.php"><i class="far fa-calendar-alt menu-link-icon"></i> <span class="menu-link-text">Calendario</span></a>';
                            echo '</li>';
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../equipos/list.php"><i class="fa fa fa-list menu-link-icon"></i> <span class="menu-link-text">Equipos</span></a>';
                            echo '</li>';
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="#" id="dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs menu-link-icon"></i> <span class="menu-link-text">Administrar</span> <i class="fa fa-chevron-down"></i></a>';
                            echo '<ul class="dropdown-menu">';
                            echo '<li><a class="text-center" href="../administrador/playsAdmin.php">Juegos</a></li>';
                            echo '<li><a class="text-center" href="../administrador/teamsAdmin.php">Equipos</a></li>';
                            echo '<li><a class="text-center" href="../administrador/usersAdmin.php">Usuarios</a></li>';
                            echo '<li><a class="text-center" href="../administrador/poolAdmin.php">Quiniela</a></li>';                                 
                            echo '</ul>';
                            echo '</li>';                                                                        
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../usuario/perfil.php"><i class="fa fa-user menu-link-icon"></i> <span class="menu-link-text">Mi perfil</span></a>';
                            echo '</li>';    
                            echo '<li class="dropdown" style="border-right: 0px solid rgb(228, 72, 0);">';
                            echo '<a href="../session/logout.php"><i class="fa fa-sign-out-alt menu-link-icon"></i> <span class="menu-link-text">Cerrar sesión</span></a>';
                            echo '</li>';  
                        }else{
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0); border-left: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../partidos/calendario.php"><i class="far fa-calendar-alt menu-link-icon"></i> <span class="menu-link-text">Calendario</a>';
                            echo '</li>';
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../equipos/list.php"><i class="fa fa fa-list menu-link-icon"></i> <span class="menu-link-text">Equipos</span></a>';
                            echo '</li>';
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../apuestas/list.php"><i class="fa fa-chart-area menu-link-icon"></i> <span class="menu-link-text">Predecir</span></a>';
                            echo '</li>';
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../usuario/puntaje.php"><i class="fa fa-star menu-link-icon"></i> <span class="menu-link-text">Mis puntos</span></a>';
                            echo '</li>';     
                            echo '<li class="dropdown" style="border-right: 3px solid rgb(228, 72, 0);">';
                            echo '<a href="../usuario/perfil.php"><i class="fa fa-user menu-link-icon"></i> <span class="menu-link-text">Mi perfil</span></a>';
                            echo '</li>';    
                            echo '<li class="dropdown" style="border-right: 0px solid rgb(228, 72, 0);">';
                            echo '<a href="../session/logout.php"><i class="fa fa-sign-out-alt menu-link-icon"></i> <span class="menu-link-text">Cerrar sesión</span></a>';
                            echo '</li>';                                                                                                                            
                        }
                    ?>                           
                </ul>
            </div>
        </nav>
        <div class="mobile-dropdown-menu" id="mobile-dropdown-menu" style="display: none;">
            <span class="box">
                <span class="option"><a class="text-center" href="../administrador/playsAdmin.php">JUEGOS</a></span>
                <span class="option"><a class="text-center" href="../administrador/teamsAdmin.php">EQUIPOS</a></span>
                <span class="option"><a class="text-center" href="../administrador/usersAdmin.php">USUARIOS</a></span>
                <span class="option"><a class="text-center" href="../administrador/poolAdmin.php">QUINIELA</a></span>
            </span>
        </div>
     </center>
  </body>
</html>

<script>
$(document).ready(function(){
    $("#dropdown-toggle").click(function(){
        $("#mobile-dropdown-menu").toggle();
    })
})
setTimeout(function(){
    var hours, minutes, date, seconds, part, nhours, nminutes, nseconds;

    hours = Number($('#hours').val());
    minutes = Number($('#minutes').val());
    seconds = Number($('#seconds').val());
    part = $('#part').val();
    if(part == "pm" && hours != 12){
        hours += 12;
    }else if(hours == 12 && part == "am"){
        hours = 24;
    }

    setInterval(updateTime,1000);

    function updateTime(){
        if(seconds == 59){
            seconds = 0;
            if(minutes == 59){
                minutes = 0;
                if(hours == 24){
                    hours = 1;
                }else{
                    hours++;
                }
            }else{
                minutes++;
            }
        }else{
            seconds++;
        }

        part = "AM";
        if(hours < 10){
            nhours = "0" + hours;
        }else if(hours == 24){
            nhours = "12";
            part = "AM";
        }else if(hours == 12){
            nhours = hours;
            part = "PM";
        }else if(hours > 12){
            nhours = hours - 12;
            if(nhours < 10){
                nhours = "0" + nhours;
            }
            part = "PM";
        }else{
            nhours = hours;
        }

        if(minutes < 10){
            nminutes = "0" + minutes;
        }else{
            nminutes = minutes;
        }

        if(seconds < 10){
            nseconds = "0" + seconds;
        }else{
            nseconds = seconds;
        }
        $('#pageTitle').html("<font size=6><b>QUINIELA</b></font><font size=4> <span class='title-clock'><i class='fas fa-clock'></i> " + nhours + ":" + nminutes + ":" + nseconds + " " + part + "</span></font>");
    }
}, 500);

</script>
