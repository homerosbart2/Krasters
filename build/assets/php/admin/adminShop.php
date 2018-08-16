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
                <div class="form-container">

                    <h1>ADMINISITRACIÓN DE <span class="company-name"><b>KRAS</b>TERS</span></h1>

                    <form action="" class="button-bar">
                        <input type="radio" name="gender" id="add-new-section" value="male">
                        <label for="add-new-section" class="btn-menu" >
                            Agregar nuevo
                        </label>
                        <input type="radio" name="gender" id="add-existence-section" value="female"> 
                        <label for="add-existence-section" class="btn-menu">
                            Agregar existencia
                        </label>
                        <input type="radio" name="gender" id="edit-section" value="other"> 
                        <label for="edit-section" class="btn-menu">
                        <i class="fas fa-edit"></i> Editar
                        </label>
                        
                    </form>

                    <span class="separation l"></span>

                    <span id="form-title" class="form-title"></span>
                    <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Administra <span class="company-name"><b>KRAS</b>TERS</span> seleccionando una sección.</span>
                    <form id="admin-shop-form-add" class="admin-shop-form">
                    <input type='text' id='producto_nombre' name='' placeholder='Nombre' required>
                    <span class='form-row'>
                        <span class="input-icon">
                        <select name="color-select" id="color-select">
                            <option value="0" disabled selected>Color</option>
                            <option value="rojo">Rojo</option>
                            <option value="azul">Azul</option>
                            <option value="negro">Negro</option>
                            <option value="blanco">Blanco</option>
                        </select>
                        <i class="fas fa-fill-drip"></i>
                        </span>
                        <span class="input-icon">
                            <input type='text' id='producto_precio' name='' placeholder='Precio' required>
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                    </span>
                    <span class='form-row'>
                        <span class="input-icon">
                            <input type='text' id='producto_talla' name='' placeholder='Talla' required>
                            <i class="fas fa-shoe-prints"></i>
                        </span>
                        <span class="input-icon">
                            <input type='text' id='producto_cantidad' name='' placeholder='Cantidad' required>
                            <i class="fas fa-layer-group"></i>
                        </span>
                    </span>
                    <textarea id="producto_descripcion" rows="4" cols="50" name="comment" form="admin-shop-form" placeholder='Ingresa una descripción'></textarea>
                    <input type="file" name="file" id="file" class="inputfile" />
                    <span class="input-container"><label for="file"><i class="fas fa-file-image"></i></label><span id="file-name"></span></span>
                    <span class="form-row">
                        <span></span>
                        <a class="btn-register"><i class="fas fa-plus"></i> Agregar</a>
                    </span>
                    </form>
                    <form id="admin-shop-form-existence" class="admin-shop-form">
                        <select name="color-select" id="color-select">
                            <option value="0" disabled selected>Seleccione producto</option>
                            <option value="p1">Producto 1</option>
                            <option value="p2">Producto 2</option>
                            <option value="p3">Producto 3</option>
                        </select>
                        <span class="form-row">
                            <span class="input-icon">
                                <input type='text' id='producto_talla' name='' placeholder='Talla' required>
                                <i class="fas fa-shoe-prints"></i>
                            </span>
                            <span class="input-icon">
                                <input type='text' id='producto_cantidad' name='' placeholder='Cantidad' required>
                                <i class="fas fa-layer-group"></i>
                            </span>
                        </span>
                        <span class='form-row'>
                            <span class="input-icon">
                            <select name="color-select" id="color-select">
                                <option value="0" disabled selected>Color</option>
                                <option value="rojo">Rojo</option>
                                <option value="azul">Azul</option>
                                <option value="negro">Negro</option>
                                <option value="blanco">Blanco</option>
                            </select>
                            <i class="fas fa-fill-drip"></i>
                            </span>
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                    </form>
                    <form id="admin-shop-form-edit" class="admin-shop-form">
                        <select name="color-select" id="color-select">
                            <option value="0" disabled selected>Seleccione producto</option>
                            <option value="p1">Producto 1</option>
                            <option value="p2">Producto 2</option>
                            <option value="p3">Producto 3</option>
                        </select>
                        <input type='text' id='producto_nombre' name='' placeholder='Nombre' required>
                        <span class="input-icon">
                            <input type='text' id='producto_precio' name='' placeholder='Precio' required>
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <textarea id="producto_descripcion" rows="4" cols="50" name="comment" form="admin-shop-form" placeholder='Ingresa una descripción'></textarea>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register"><i class="fas fa-save"></i> Guardar</a>
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
    $(document).ready(function(){
        $("#admin-shop-form-add").hide();
        $("#admin-shop-form-existence").hide();
        $("#admin-shop-form-edit").hide();
    });

    $('#file').click(function() {
        $('#file').change(function() {
            var filename = document.getElementById("file").files[0].name;
            console.log(filename);
            $('#file-name').html(' ' + filename + ' <i class="fas fa-check"></i>');
        });
    });

    $("#add-new-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").show();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").hide();
            $("#form-title").html("<b>AGREGAR</b> PRODUCTO");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega nuevos productos a <span class="company-name"><b>KRAS</b>TERS</span> y llena la tienda.');
        }
    });

    $("#add-existence-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").show();
            $("#admin-shop-form-edit").hide();
            $("#form-title").html("<b>AGREGAR</b> EXISTENCIA");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega existencia a los productos ya incluidos en <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });

    $("#edit-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").show();
            $("#form-title").html("<b>EDITAR</b> PRODUCTO");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Edita el precio, descripción y nombre de un producto de <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });
</script>