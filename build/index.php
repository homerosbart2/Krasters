<!DOCTYPE html>
<html lang="en">

<head>
    <title>Krasters</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/pnotify.custom.min.js" type="text/javascript"></script>
    <link href="assets/css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.css" media="all" rel="stylesheet" type="text/css" />    
    <link rel="stylesheet" href="assets/css/main.min.css" />
</head>

<body>
    <section id="header">
        <div class="wrapper">
            <div class="login-register">
                <span class="login-logo">
                    <b>KRAS</b>TERS
                </span>
                <div class="form-container">
                   
                    <form id="login-form" class="login-form">
                        <input type='hidden' name='add' value='G'>
                        <input type='text'  id='login-username' name='' placeholder='Ingrese el usuario' required>
                        <input type='password'  id='login-password' name='' placeholder='Ingrese la contraseña' required>
                        <span class="login-buttons">
                            <a href="#" type='submit' id='btn_login' name='submit' value='Iniciar' class='btn-login iniciar_sesion'> LOGIN </a>
                            <a class='btn-register' onclick='updateFormContainer();'> Registrar</a> 
                        </span>
                    </form>

                    <form id="register-form" class="register-form">
                        <input type='hidden'name='add' value='G'>
                        <input type='text' id='registro_nombre' name='' placeholder='Ingrese el nombre' required>
                        <input type='text' id='registro_username' name='' placeholder='Ingrese el usuario' required>
                        <input type='password' id='registro_password1' name='' placeholder='Ingrese la contraseña' required>
                        <input type='password'  id='registro_password2' name='' placeholder='Repita la contraseña' required>
                        <span class="login-buttons">
                            <a class='btn-cancel' onclick='updateFormContainer();'>Cancelar</a>
                            <a href="#" type='submit' id='btn_registrar' name='submit' value='Iniciar' class='btn-login iniciar_sesion'> REGISTRAR </a>
                             
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="./assets/js/vendors.js"></script>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/actions.js"></script>
</body>

</html>

<script>

function renderAdminUser(){
    //Luego de 1 segundo se redirige
    $(location).attr('href', 'php/admin/adminShop.php');
  }

function renderUser(){
  //Luego de 1 segundo se redirige
  $(locarion).attr('href','php/shop/home.php')
} 

var iniciarSesion = function(){
  username = document.getElementById("login-username").value;
  password = document.getElementById("login-password").value;
  if(username != "" && password != ""){
    $.ajax({
        url: 'php/session/validar_login.php?username=' + username + '&password=' + password,
        type: 'POST',
        success: function(r){
          if(r != 0){
            new PNotify({
              title: 'Login',
              text: 'Bienvenido ' + username + ".",
              type: 'success',
              styling: 'bootstrap3'
            });
            //setTimeout("renderUser()",1000);        
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
  }else{
    new PNotify({
      title: 'Login',
      text: 'Complete todos los campos porfavor.',
      type: 'warning',
      styling: 'bootstrap3'
    });       
  }    
}

var crearUsuario = function(){
  nombre = document.getElementById("registro_nombre").value;
  username = document.getElementById("registro_username").value;
  password1 = document.getElementById("registro_password1").value;
  password2 = document.getElementById("registro_password2").value;
  if(password1 == password2 && password1 != "" && password2 != ""){
    if(username != "" && nombre != ""){
        $.ajax({
            url: 'php/usuario/nuevo_usuario.php?name=' + nombre + '&username=' + username + '&password=' + password1,
            type: 'POST',
            success: function(r){
                alert(r);
                if(r != -1){
                    new PNotify({
                    title: 'Nuevo usuario',
                    text: 'Bienvenido ' + username + ".",
                    type: 'success',
                    styling: 'bootstrap3'
                    });
                    if(r == 0) setTimeout("renderUser()",1000);    
                    else setTimeout("renderAdminUser()",1000);      
                }else{
                    new PNotify({
                    title: 'Nuevo usuario',
                    text: 'El usuario ' + username + " ya se encuentra en el sistema.",
                    type: 'error',
                    styling: 'bootstrap3'
                    });           
                }
            }
        });
    }else{
        new PNotify({
        title: 'Nuevo usuario',
        text: 'Complete ambos campos porfavor.',
        type: 'warning',
        styling: 'bootstrap3'
        });       
    }         
  }else{
    new PNotify({
        title: 'Nuevo usuario',
        text: 'Ambas contraseñas deben coincidir.',
        type: 'warning',
        styling: 'bootstrap3'
    });       
  }
}

$(document).ready(function() {
  $('#btn_login').on('click',function(){
    iniciarSesion();
  });

  $('#btn_registrar').on('click',function(){
    crearUsuario();
  });
  
});
</script>