<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administración</title>
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
    <section id="header-admin">
        <div class="wrapper">
            <div class="shop-admin">
                <span class="title">
                    <b>AGREGAR</b> PRODUCTO
                </span>
                <div class="form-container">
                    <form id="admin-shop-form" class="admin-shop-form">
                    <input type='text' id='producto_nombre' name='' placeholder='Nombre' required>
                    <span class='form-row'>
                        <select name="color-select" id="color-select">
                            <option value="rojo">Rojo</option>
                            <option value="azul">Azul</option>
                            <option value="negro">Negro</option>
                            <option value="blanco">Blanco</option>
                        </select>
                        <input type='text' id='producto_precio' name='' placeholder='Precio' required>
                    </span>
                    <textarea rows="4" cols="50" name="comment" form="usrform" placeholder='Ingresa una descripción'></textarea>
                    <input type="file" name="file" id="file" class="inputfile" />
                    <span class="input-container"><label for="file"><i class="fas fa-file-image"></i></label><span id="file-name"></span></span>
                    <span class="form-row">
                        <span></span>
                        <a class="btn-register"><i class="fas fa-plus"></i></a>
                    </span>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="../../js/vendors.js"></script>
    <script src="../../js/app.js"></script>
    <script src="../../js/actions.js"></script>
</body>

</html>

<script>
    $('#file').click(function() {
        $('#file').change(function() {
            var filename = document.getElementById("file").files[0].name;
            console.log(filename);
            $('#file-name').html(' ' + filename + ' <i class="fas fa-check"></i>');
        });
    });
</script>