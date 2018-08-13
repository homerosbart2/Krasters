<html>
  <head>
    <title>Tienda</title>
      <link href="../css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
      <link href="../css/bootstrap.css" rel="stylesheet">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/pnotify.custom.min.js"></script>
  </head>
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav" style="backgorund:white;">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php">Mi Quiniela</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../index.php">Menú</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default" style="margin-top:40%;">
            <div class="panel-heading">
              <h3 class="panel-title">Porfavor inicie sesión!</h3>
          </div>
            <div style="margin-top:10%;">
              <form>
                    <div class="form-group">
                      <input class="form-control" placeholder="username" id="login-username" name="username" type="text">
                    </div>
                    <div class="form-group">
                      <input class="form-control" placeholder="Password" id="login-password" name="password" type="password" value="">
                    </div>  
                    <a id="iniciar-sesion" class="btn btn-primary btn-lg btn-block" type="submit" style="margin-right: 5px; color:#FFFFFF; background:##5cb85c; padding: 3px 15px; background-color: #COLOR;border: 0; color: #COLOR; border-radius: 3px;">
                      <span class="" id="iniciar-sesion">Iniciar sesión</span>
                    </a>                      
              </form>
            </div>
        </div>
      </div>
    </div>
</body>



<script>

    //.bg-secondary
    
    function renderAdmin(){
      //Luego de 1 segundo se redirige al dashboard
      $(location).attr('href', "../administrador/playsAdmin.php");
    }

    function renderUser(){
      //Luego de 1 segundo se redirige al dashboard
      $(location).attr('href', "../usuario/puntaje.php");
    }   

    function verifyLogin(){
        var username = $("#login-username").val();
        var password = $("#login-password").val();
        $.ajax({
            url: "verificar_data.php?username=" + username + "&password=" + password,
            type: "POST",
            success: function(r){
                // logro devolver algo el ajax
                if(r == 0){
                  //success            
                  new PNotify({
                    title: 'Login',
                    text: 'Bienvenido ' + username,
                    type: 'success',
                    styling: 'bootstrap3'
                  }); 
                  setTimeout("renderAdmin()",1000);       
                }else if(r == 1){
                  //success            
                  new PNotify({
                    title: 'Login',
                    text: 'Bienvenido ' + username,
                    type: 'success',
                    styling: 'bootstrap3'
                  }); 
                  setTimeout("renderUser()",1000);                    
                }else{
                  new PNotify({
                    title: 'Login',
                    text: 'Porfavor verifique sus datos.',
                    type: 'error',
                    styling: 'bootstrap3'
                  });                   
                }
            }, 

            // de lo contrario hubo error
            error: function(request, status, error){
                aler("error " + reques.responseText);
            }
        });
    }

    $(document).ready(function(){
        $("#iniciar-sesion").on('click',function() {verifyLogin()});
    });
</script>