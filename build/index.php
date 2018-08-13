<!DOCTYPE html>
<html lang="en">

<head>
    <title>Krasters</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
                    <form id="login-form" class="login-form" action='index.php' method='post'>
                    <input type='hidden' name='add' value='G'>
                    <input type='text'  name='login-username' placeholder='username' required>
                    <input type='password'  name='login-password' placeholder='default' required>
                    <span class="login-buttons">
                        <input class='btn-login' type='submit' name='submit' value='Iniciar' class='btn3'>
                        <a class='btn-register' onclick='updateFormContainer();'>Registrar</a> 
                    </span>
                    </form>

                    <form id="register-form" class="register-form" action='index.php' method='post'>
                    <input type='hidden' name='add' value='G'>
                    <input type='text'  name='login-username' placeholder='username' required>
                    <input type='password'  name='login-password' placeholder='default' required>
                    <input type='password'  name='login-password-confirmation' placeholder='default' required>
                    <span class="login-buttons">
                        <input class='btn-login' type='submit' name='submit' value='Aceptar' class='btn3'>
                        <a class='btn-register' onclick='updateFormContainer();'>Cancelar</a> 
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