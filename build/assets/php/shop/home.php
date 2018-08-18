<html>
<head>
    <title>Krasters</title>
    <script src="../../js/jquery.min.js" type="text/javascript"></script>
    <script src="../../js/pnotify.custom.min.js" type="text/javascript"></script>
    <link href="../../css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../css/bootstrap.css" media="all" rel="stylesheet" type="text/css" />    
    <link rel="stylesheet" href="../../css/main.min.css" />    
</head>
</html>
<body>

    <div class="row col-md-12 col-sm-12 col-xs-12" style="margin:0; padding:0;">
        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding:0; background-color: white; height:100%;"> 
            <!-- NO SE SI LO VAS A CAMBIAR PERO ASI ME GUSTA QUE SE VEA -->
            <!-- EN EL DIV SE METEN LOS PRODUCTOS -->
            <div id="productos"> 
            </div>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10" style="margin:0; padding:0; background-color: white; height:100%;">      
        </div>      
    </div>
</body>

<style>
html, body {
    margin: 0;
    padding: 0;
}
</style>
<script>

function load_productos(){
    $.ajax({
        url: 'assets/php/session/validar_login.php?username=' + username + '&password=' + password,
        type: 'POST',
        success: function(r){
          if(r != -1){
            new PNotify({
              title: 'Login',
              text: 'Bienvenido ' + username + ".",
              type: 'success',
              styling: 'bootstrap3'
            });
            if(r == 0) setTimeout("renderAdminUser()",1000); //SUPERADMIN ROLE        
            else setTimeout("renderUser()",1000); //ADMIN ROLE
          }else{
            new PNotify({
              title: 'Login',
              text: 'Usuario inválido.',
              type: 'error',
              styling: 'bootstrap3'
            });           
          }
        }        
    });
}

$(document).ready(function(){
    load_productos();
});
</script>