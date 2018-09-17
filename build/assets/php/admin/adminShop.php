<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administración</title>    
    <link rel="stylesheet" href="../../css/bootstrap.min.css"  media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/bootstrap-select.css"  media="all" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"  type="text/javascript"></script> 
    <script src="../../js/bootstrap-select.js" type="text/javascript"></script> 
</head>

<?php
    include '../modules/nav.php';
    if($role != 0){
       echo  "<script> $(location).attr('href','../../../index.php') </script>";
    }
?>

<body>
    <section id="header-admin">
        <div class="wrapper">
            <div class="shop-admin">
                <div class="form-container">
                    <h1>ADMINISITRACIÓN DE <span class="company-name"><b>KRAS</b>TERS</span></h1>

                    <form action="" class="button-bar">
                        <input type="radio" name="menu-bar" id="add-new-section" value="0">
                        <label for="add-new-section" class="btn-menu" >
                            Agregar nuevo
                        </label>
                        <input type="radio" name="menu-bar" id="add-existence-section" value="1"> 
                        <label for="add-existence-section" class="btn-menu">
                            Agregar existencia
                        </label>
                        <input type="radio" name="menu-bar" id="edit-section" value="2"> 
                        <label for="edit-section" class="btn-menu">
                        <i class="fas fa-edit"></i> Editar
                        </label>
                        <input type="radio" name="menu-bar" id="brand-color-section" value="3"> 
                        <label for="brand-color-section" class="btn-menu">
                            Marcas y colores
                        </label>
                        
                    </form>

                    <span class="separation l"></span>

                    <span id="form-title" class="form-title"></span>
                    <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Administra <span class="company-name"><b>KRAS</b>TERS</span> seleccionando una sección.</span>
                    <form id="admin-shop-form-add" class="admin-shop-form">
                    <input type='text' id='producto_nombre' placeholder='Nombre' required>
                    <span class='form-row'>
                        <span class="input-icon">
                            <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="color-select">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT C.color_nombre,C.color_codigo FROM Colores as C order by C.color_nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione color</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $codigo=$row["color_nombre"];
                                        $nombre=$row["color_nombre"];
                                        echo "<option value='".$codigo."'>".$nombre."</option>";         
                                    }
                                    pg_close($link);
                                ?>
                            </select>
                            <i class="fas fa-paint-roller"></i>
                        </span>
                        <span class="input-icon">
                            <input type='number' min="1" id='producto_precio' placeholder='Precio' required>
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                    </span>
                    <span class='form-row'>
                        <span class="input-icon">
                            <input type='number' min="25" id='producto_talla' placeholder='Talla' required>
                            <i class="fas fa-shoe-prints"></i>
                        </span>
                        <span class="input-icon">
                            <input type='number' min="1" id='producto_cantidad' placeholder='Cantidad' required>
                            <i class="fas fa-layer-group"></i>
                        </span>
                    </span>
                    <span class="input-icon">
                        <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="marca-select">
                            <?php
                                $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                $query = "SELECT M.marca_nombre FROM Marcas as M order by M.marca_nombre";
                                $result = pg_query($link, $query);
                                echo "<option value=default selected=selected disabled>Seleccione marca</option>";
                                while ($row = pg_fetch_assoc($result)){
                                    $codigo=$row["marca_nombre"];
                                    $nombre=$row["marca_nombre"];
                                    echo "<option value='".$codigo."'>".$nombre."</option>";         
                                }
                                pg_close($link);
                            ?>  
                        </select>
                        <i class="fas fa-adjust"></i>
                    </span>
                    
                    <textarea id="producto_descripcion" rows="4" cols="50" form="admin-shop-form" placeholder='Ingresa una descripción'></textarea>
                    <input type="file" id="product-image" class="inputfile" name="file" required />
                    <span class="input-container"><label for="product-image"><i class="fas fa-file-image"></i></label><span id="file-name"></span></span>                 
                    <div id="image_preview_producto"><img id="previewing_producto"/></div>
                    <div id="messageProductos"></div>
                    <span class="form-row">
                        <span></span>
                        <a class="btn-register" id="btn_agregar_producto"><i class="fas fa-plus"></i> Agregar</a>
                    </span>
                    </form>


                    <form id="admin-shop-form-existence" class="admin-shop-form">
                        <span class="input-icon">
                            <select class="selectpicker" data-live-search="true" data-live-search-style="startsWith"  id="product-select1">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT P.producto_id,P.producto_nombre,M.marca_nombre FROM Productos as P, Marcas as M WHERE P.marca_nombre = M.marca_nombre ORDER BY P.producto_nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione producto</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $nombre=$row["producto_nombre"];
                                        $marca=$row["marca_nombre"];
                                        $producto=$row["producto_id"];
                                        echo "<option value='".$producto."'>".$nombre.' - [ '.$marca."]</option>";         
                                    }
                                    pg_close($link);
                                ?>
                            </select>
                        </span>
                        
                        <span class='form-row'>
                            <span class="input-icon">
                                <input type='number' min="25" id='producto_talla_existencia' placeholder='Talla' required>
                                <i class="fas fa-shoe-prints"></i>
                            </span>
                            <span class="input-icon">
                                <input type='number' min="1" id='producto_cantidad_existencia' placeholder='Cantidad' required>
                                <i class="fas fa-layer-group"></i>
                            </span>
                        </span>
                        
                        <span class='form-row'>
                            <span class="input-icon">
                                <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="color-select2">
                                    <?php
                                        $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                        $query = "SELECT C.color_nombre,C.color_codigo FROM Colores as C order by C.color_nombre";
                                        $result = pg_query($link, $query);
                                        echo "<option value=default selected=selected disabled>Seleccione color</option>";
                                        while ($row = pg_fetch_assoc($result)){
                                            $codigo=$row["color_nombre"];
                                            $nombre=$row["color_nombre"];
                                            echo "<option value='".$codigo."'>".$nombre."</option>";         
                                        }
                                        pg_close($link);
                                    ?>
                                </select>
                                <i class="fas fa-paint-roller"></i>
                            </span>
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="btn_agregar_existencia_producto"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                    </form>

                    <form id="admin-shop-form-edit" class="admin-shop-form">
                        <span class="input-icon">
                            <select class="selectpicker" data-live-search="true" id="product-select2">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT P.producto_id,P.producto_nombre,M.marca_nombre FROM Productos as P, Marcas as M WHERE P.marca_nombre = M.marca_nombre ORDER BY P.producto_nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione producto</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $nombre=$row["producto_nombre"];
                                        $marca=$row["marca_nombre"];
                                        $producto=$row["producto_id"];
                                        echo "<option value='".$producto."'>".$nombre.' - [ '.$marca."]</option>";         
                                    }
                                    pg_close($link);
                                ?>  
                            </select>
                        </span>
                        
                        <input type='text' id='producto_nombre_editar' placeholder='Nombre' required>
                        <span class="input-icon">
                            <input type='number' min="1" id='producto_precio_editar' placeholder='Precio' required>
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <textarea id="producto_descripcion_editar" rows="4" cols="50" form="admin-shop-form" placeholder='Ingresa una descripción'></textarea>
                        <span class="form-row">
                            <a class="btn-cancel" id="btn_eliminar_producto"><i class="fas fa-trash-alt"></i> Eliminar</a>
                            <a class="btn-register" id="btn_editar_producto"><i class="fas fa-save"></i> Guardar</a>
                        </span>
                    </form>

                    <form id="admin-shop-form-brand-color" class="admin-shop-form">
                        <input type='text' id='marca_nombre' placeholder='Nombre' required>

                        <input type="file" id="marca-image" class="inputfile" name="file" required />
                        <span class="input-container"><label for="marca-image"><i class="fas fa-file-image"></i></label><span id="brand-image-name"></span></span>                 
                        <div id="image_preview_marca"><img id="previewing_marca"/></div>
                        <div id="messageMarcas"></div>   

                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="btn_agregar_marca"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                        <span  id="listado-marcas">
                            <!-- LISTAR POR AJAX --> 
                        </span>

                        <span class="separation xl"></span>
                        <span id="form-title" class="form-title"><b>AGREGAR</b> COLOR</span>
                        <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Agrega nuevos colores para los productos de <span class="company-name"><b>KRAS</b>TERS</span>.</span>
                        <span class="form-row">
                            <span class="input-icon">
                                <input type='text' id='color_nombre' placeholder='Nombre' required>
                            </span>
                            <span class="input-icon">
                            <input type='text' id='color_codigo' placeholder='Codigo negro FFFFFF' required>
                                <i class="fas fa-fill-drip"></i>
                            </span>
                            
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="btn_agregar_color"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                        <span id="listado-colores">
                            <!-- LISTAR POR AJAX --> 
                        </span>

                        <span class="separation xl"></span>
                        <span id="form-title" class="form-title"><b>AGREGAR</b> LUGAR</span>
                        <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Agrega nuevos lugares de envío <span class="company-name"><b>KRAS</b>TERS</span>.</span>
                        <span class="form-row">
                            <span class="input-icon">
                                <input type='text' id='lugar_nombre' placeholder='Guatemala' required>
                            </span>
                            <span class="input-icon">
                            <input type='text' id='lugar_codigo' placeholder='01000' required>
                                <i class="fas fa-fill-drip"></i>
                            </span>
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="btn_agregar_lugar"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                        <span class="separation l" id="listado-lugares">
                            <!-- LISTAR POR AJAX --> 
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
    var imagenValidaMarca =  false;
    var imagenValida = false;
    var imageFileMarca = null;
    var imageFileProducto = null;
    $(document).ready(function(){
        $("#admin-shop-form-add").hide();
        $("#admin-shop-form-existence").hide();
        $("#admin-shop-form-edit").hide();
        $("#admin-shop-form-brand-color").hide();
    });

    $('#product-image').click(function() {
        $('#product-image').change(function() {
            var filename = document.getElementById("product-image").files[0].name;
            console.log(filename);
            $('#file-name').html(' ' + filename + ' <i class="fas fa-check"></i>');
        });
    });

    $('#brand-image').click(function() {
        $('#brand-image').change(function() {
            var filename = document.getElementById("brand-image").files[0].name;
            console.log(filename);
            $('#brand-image-name').html(' ' + filename + ' <i class="fas fa-check"></i>');
        });
    });

    $("#add-new-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").show();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").hide();
            $("#admin-shop-form-brand-color").hide();
            $("#form-title").html("<b>AGREGAR</b> PRODUCTO");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega nuevos productos a <span class="company-name"><b>KRAS</b>TERS</span> y llena la tienda.');
        }
    });

    $("#add-existence-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").show();
            $("#admin-shop-form-edit").hide();
            $("#admin-shop-form-brand-color").hide();
            $("#form-title").html("<b>AGREGAR</b> EXISTENCIA");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega existencia a los productos ya incluidos en <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });

    $("#edit-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").show();
            $("#admin-shop-form-brand-color").hide();
            $("#form-title").html("<b>EDITAR</b> PRODUCTO");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Edita el precio, descripción y nombre de un producto de <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });

    $("#brand-color-section").click(function(){
        listarMarcas();
        listarColores();
        listarLugares();
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").hide();
            $("#admin-shop-form-brand-color").show();
            $("#form-title").html("<b>AGREGAR</b> MARCA");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega las marcas registradas de los productos de <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });

    function renderPage(){
        //Luego de 1 segundo se redirige hacia la misma pagina
         $(location).attr('href','adminShop.php')
    } 

    $(document).ready(function(){
        //Agregar nuevo producto
        $('#btn_agregar_producto').on('click', function(){
            nombre = document.getElementById("producto_nombre").value;
            descripcion = document.getElementById("producto_descripcion").value;
            precio = parseFloat(document.getElementById("producto_precio").value);
            talla = parseInt(document.getElementById("producto_talla").value);
            cantidad = parseInt(document.getElementById("producto_cantidad").value);
            color = $("#color-select").val();
            marca = $("#marca-select").val();
            if((precio > 0)&&(cantidad > 0)&&(talla > 0)&&(color != null)&&(marca != null)&&(nombre != "")){
                if(imagenValida){
                    $.ajax({
                        url: "../rutas_ajax/productos/insertar.php?nombre=" + nombre + "&descripcion=" + descripcion + "&precio=" + precio + "&talla=" + talla + "&cantidad=" + cantidad + "&color=" + color + "&marca=" + marca + "&type=" + imageFileProducto.split("/")[1],
                        type: "POST",
                        success: function(r){
                            //en r viene el id
                            if(r > 0){
                                //primer select
                                /*
                                select = document.getElementById('product-select1');
                                select.options[select.options.length] = new Option(r, nombre);
                                //segundo select
                                select = document.getElementById('product-select2'); 
                                select.options[select.options.length] = new Option(r, nombre);   
                                */
                                new PNotify({
                                    title: 'Nuevo producto',
                                    text: 'Producto ingresado exitosamente.',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                document.getElementById("producto_nombre").value = "";
                                document.getElementById("producto_descripcion").value = "";
                                document.getElementById("producto_precio").value = "";
                                document.getElementById("producto_talla").value = "";
                                document.getElementById("producto_cantidad").value = "";                                                       
                                //si el producto es guardado guardo la imagen
                                var x = document.getElementById("product-image");
                                file = x.files[0];
                                if(file != undefined){
                                    var formData = new FormData();
                                    formData.append('file', file, 'test.png');
                                    $.ajax({
                                        url: "../rutas_ajax/image_upload.php?folder=productos&nombre=" + r + "&type=" + imageFileProducto.split("/")[1], // Url to which the request is send
                                        type: "POST", // Type of request to be send, called as method
                                        data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                        contentType: false, // The content type used when sending data to the server.
                                        cache: false, // To unable request pages to be cached
                                        processData: false, // To send DOMDocument or non processed data file it is set to false
                                        success: function(data) // A function to be called if request succeeds
                                        {
                                            alert(data);
                                            $('#image_preview_marca').css("display", "none");
                                        }
                                    });
                                }                       
                                setTimeout("renderPage()",500); //RENDER POR QUE NO ME ACTUALIZAN LOS SELECT USANDO EL SELECTPICKER
                            }else{
                                new PNotify({
                                    title: 'Nuevo producto',
                                    text: 'Error al insertar producto, verifique sus datos.',
                                    type: 'error',
                                    styling: 'bootstrap3'
                                });
                            }                        
                        }
                    });
                }else{
                    new PNotify({
                        title: 'Imagen producto',
                        text: 'La imagen seleccionada es invalida.',
                        type: 'warning',
                        styling: 'bootstrap3'
                    });                    
                }
            }else{
                new PNotify({
                    title: 'Nuevo producto',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }                       
        });

        // PRODUCTOS - Valido desde antes que la imagen sea png 
        $('#product-image').on('change', function(){
            if(this != undefined){
                $("#messageProductos").empty(); //Limpiamos el mensaje anterior
                var file = this.files[0];
                imageFileProducto = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg", "image/webp"];
                alert(imageFileProducto.split("/")[1]);
                if (!(imageFileProducto == match[0] || imageFileProducto == match[1] || imageFileProducto == match[2] || imageFileProducto == match[3])){
                    // $('#previewing_producto').attr('src', '../../img/productos/default.png');
                    // $('#previewing_producto').attr('width', 270)
                    // $('#previewing_producto').attr('height', 200)
                    $("#messageProductos").html("<p id='error'>Porfavor seleccione un archivo valido de imagen</p><span id='error_message'>Solamente imagenes .png son permitidas</span>");
                    imagenValida =  false;
                } else {
                    imagenValida = true;
                    var reader = new FileReader();
                    reader.onload = imageIsLoadedProducto;
                    reader.readAsDataURL(this.files[0]);
                }
            }
        });

        function imageIsLoadedProducto(e) {
            $("#product-image").css("color", "green");
            $('#image_preview_producto').css("display", "block");
            $('#previewing_producto').attr('src', e.target.result);
            $('#previewing_producto').attr('width', '180px');
            $('#previewing_producto').attr('height', '130px');
        };
        
        //Agregar existencia producto
        $('#btn_agregar_existencia_producto').on('click', function(){
            producto = $("#product-select1").val();
            cantidad = parseFloat(document.getElementById("producto_cantidad_existencia").value);
            talla = parseInt(document.getElementById("producto_talla_existencia").value);
            color = $("#color-select2").val();
            if((talla > 0)&&(cantidad != null)&&(color != null)&&(producto != null)){
                $.ajax({
                    url: "../rutas_ajax/productos/editar_insertar.php?talla=" + talla + "&cantidad=" + cantidad + "&color=" + color + "&producto=" + producto,
                    type: "POST",
                    success: function(r){
                        //si actualizo devolvera 0, si creo un nuevo producto devuelve 1, si hubo error -1
                        if(r > 0){
                            //lo que intentamos quitar excede del actual
                            new PNotify({
                                title: 'Descontar producto',
                                text: 'El producto excede las existencias en inventario, actualmente existen ' + r + ' unidades en inventario',
                                type: 'success',
                                styling: 'bootstrap3'
                            });                            
                        }else if(r == -1){ //creamos un producto nuevo   
                            new PNotify({
                                title: 'Nuevo producto',
                                text: 'Producto ingresado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            document.getElementById("producto_talla_existencia").value = "";
                            document.getElementById("producto_cantidad_existencia").value = "";                                                 
                        }else if(r == -2){ //actualizo productos
                            new PNotify({
                                title: 'Agregar existencias',
                                text: 'Inventario actualizado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            document.getElementById("producto_talla_existencia").value = "";
                            document.getElementById("producto_cantidad_existencia").value = "";                             
                        }else if(r == -3){ //Desconto productos
                            new PNotify({
                                title: 'Descontar existencias',
                                text: 'Inventario actualizado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            document.getElementById("producto_talla_existencia").value = "";
                            document.getElementById("producto_cantidad_existencia").value = "";  
                        }else{
                            new PNotify({
                                title: 'Agregar existencias',
                                text: 'Error al agregar existencias verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Agregar existencias',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }                      
        });

        //Capturar el cambio en editar producto
        $("#product-select2").on('change',function(){
            producto = $("#product-select2").val();
            $.ajax({
                url: "../rutas_ajax/productos/listado.php?producto=" + producto,
                type: "POST",
                success: function(r){
                    if(r != 0){
                        obj = JSON.parse(r);                        
                        document.getElementById("producto_precio_editar").value = obj[0].precio;
                        document.getElementById("producto_nombre_editar").value = obj[0].producto_nombre;
                        document.getElementById("producto_descripcion_editar").value = obj[0].descripcion;                   
                    }
                }
            });              
        });


        var editar_eliminar = function(accion){
            producto = $("#product-select2").val();
            precio = document.getElementById("producto_precio_editar").value;
            nombre = document.getElementById("producto_nombre_editar").value;
            descripcion = document.getElementById("producto_descripcion_editar").value; 
            if((accion == 0 && producto != null) || ((accion == 1)&&(precio > 0)&&(nombre != "")&&(producto != null))){
                $.ajax({
                    url: "../rutas_ajax/productos/editar_eliminar.php?producto=" + producto + "&nombre=" + nombre + "&precio=" + precio + "&descripcion=" + descripcion + "&accion=" + accion,
                    type: "POST",
                    success: function(r){
                        //si elimino devolvera un 0, si actualizo un 1 y si hubo error -1
                        if(r == 1){ //actualizo producto
                            new PNotify({
                                title: 'Editar producto',
                                text: 'Producto actualizado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });                         
                            setTimeout("renderPage()",500); //RENDER                       
                        }else if(r == 0){ //elimino producto
                            new PNotify({
                                title: 'Eliminar producto',
                                text: 'Producto eliminado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            setTimeout("renderPage()",500); //RENDER
                        }else if(r == -2){
                            //Existencias de ese producto en inventario no se puede eliminar
                            new PNotify({
                                title: 'Eliminar producto',
                                text: 'El producto no se puede eliminar debido a que contiene existencias en el inventario.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });                            
                        }else{
                            new PNotify({
                                title: 'Editar/Eliminar producto',
                                text: 'Error al editar/eliminar producto, verifique sus datos o recuerde que no se puede eliminar un producto con existencias en inventario.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Editar/Eliminar producto',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }               
        }
        //Editar producto
        $('#btn_editar_producto').on('click', function(){
            editar_eliminar(1);
        });

        //Eliminar producto
        $('#btn_eliminar_producto').on('click', function(){
            editar_eliminar(0);
        });        

        //Agregar nueva marca
        $('#btn_agregar_marca').on('click', function(){
            nombre = document.getElementById("marca_nombre").value;
            if(nombre != "" && (imagenValidaMarca)){
                $.ajax({
                    url: "../rutas_ajax/marcas/insertar.php?nombre=" + nombre + "&type=" + imageFileMarca.split("/")[1],
                    type: "POST",
                    success: function(r){
                        //0-> guardo, -1 error
                        if(r != 1){ //Creo marca
                            new PNotify({
                                title: 'Nueva marca',
                                text: 'Marca ingresada exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });                         
                            var x = document.getElementById("marca-image");
                            file = x.files[0];
                            if(file != undefined){
                                var formData = new FormData();
                                formData.append('file', file, 'test.png');
                                $.ajax({
                                    url: "../rutas_ajax/image_upload.php?folder=marcas&nombre=" + r + "&type=" + imageFileMarca.split("/")[1], // Url to which the request is send
                                    type: "POST", // Type of request to be send, called as method
                                    data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                    contentType: false, // The content type used when sending data to the server.
                                    cache: false, // To unable request pages to be cached
                                    processData: false, // To send DOMDocument or non processed data file it is set to false
                                    success: function(data) // A function to be called if request succeeds
                                    {
                                       
                                        document.getElementById("marca-image").value = "";
                                        document.getElementById("marca_nombre").value = "";;
                                        $('#image_preview_marca').css("display", "none");
                                        setTimeout("renderPage()",500); //RENDER
                                    }
                                });
                            }   
                            listarMarcas();                     
                        }else{
                            new PNotify({
                                title: 'Nueva marca',
                                text: 'Error al insertar marca, verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Nueva marca',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }              
        });  

        // MARCAS - Valido desde antes que la imagen sea png 
        $('#marca-image').on('change', function(){
            if(this != undefined){
                $("#messageMarcas").empty(); //Limpiamos el mensaje anterior
                var file = this.files[0];
                imageFileMarca = file.type;
                match = ["image/jpeg", "image/png", "image/jpg", "image/webp"];
                if (!(imageFileMarca == match[0] || imageFileMarca == match[1] || imageFileMarca == match[2] || imageFileMarca == match[3])) {
                    // $('#previewing_producto').attr('src', '../../img/productos/default.png');
                    // $('#previewing_producto').attr('width', 270)
                    // $('#previewing_producto').attr('height', 200)
                    $("#messageMarcas").html("<p id='error'>Porfavor seleccione un archivo valido de imagen</p><span id='error_message'>Solamente imagenes .png son permitidas</span>");
                    imagenValidaMarca =  false;
                } else {
                    imagenValidaMarca = true;
                    var reader = new FileReader();
                    reader.onload = imageIsLoadedMarca;
                    reader.readAsDataURL(this.files[0]);
                }
            }
        });

        function imageIsLoadedMarca(e) {
            $("#marca-image").css("color", "green");
            $('#image_preview_marca').css("display", "block");
            $('#previewing_marca').attr('src', e.target.result);
            $('#previewing_marca').attr('width', '180px');
            $('#previewing_marca').attr('height', '130px');
        };

        //agregar nuevo color
        $('#btn_agregar_color').on('click', function(){
            nombre = document.getElementById("color_nombre").value;
            codigo = document.getElementById("color_codigo").value;
            if(nombre != ""){
                $.ajax({
                    url: "../rutas_ajax/colores/insertar.php?nombre=" + nombre + "&codigo=" + codigo,
                    type: "POST",
                    success: function(r){
                        //0-> guardo, -1 error
                        if(r == 0){ //actualizo producto
                            new PNotify({
                                title: 'Nuevo color',
                                text: 'Color ingresada exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            document.getElementById("color_nombre").value = "";
                            document.getElementById("color_codigo").value = "";   
                            listarColores();
                            setTimeout("renderPage()",500); //RENDER                                        
                        }else{
                            new PNotify({
                                title: 'Nuevo color',
                                text: 'Error al insertar color, verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Nuevo color',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }              
        });
        
        //agregar nuevo lugar
        $('#btn_agregar_lugar').on('click', function(){
            nombre = document.getElementById("lugar_nombre").value;
            codigo = document.getElementById("lugar_codigo").value;
            if(nombre != ""){
                $.ajax({
                    url: "../rutas_ajax/lugares/insertar.php?nombre=" + nombre + "&codigo=" + codigo,
                    type: "POST",
                    success: function(r){
                        //0-> guardo, -1 error
                        if(r == 0){ //actualizo producto
                            new PNotify({
                                title: 'Nuevo lugar',
                                text: 'Lugar ingresado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            document.getElementById("color_nombre").value = "";
                            document.getElementById("color_codigo").value = "";
                            listarLugares();                                           
                        }else{
                            new PNotify({
                                title: 'Nuevo lugar',
                                text: 'Error al insertar lugar, verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Nuevo lugar',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }              
        });      
        
        //FUNCIONES PARA ELIMINAR MARCAS,COLORES Y LUGARES
        $(document).on('click', '.borrar-marca', function () {
            var id = $(this).attr('id');
            eliminarMarca(id);
        });
        
        $(document).on('click', '.borrar-color', function () {
            var id = $(this).attr('id');
            eliminarColor(id);
        });
        
        $(document).on('click', '.borrar-lugar', function () {
            var id = $(this).attr('id');
            eliminarLugar(id);
        });        
    });  
    
    //FUNCIONES PARA LISTAR MARCAS,COLORES,LUGARES
    var listarMarcas = function(){
        $.ajax({
            url: "../rutas_ajax/marcas/listar.php?",
            type: "POST",
            success: function(r){
                obj = JSON.parse(r);
                var rows = "";
                if(obj.length != 0){
                    rows += "<table class='tab'>";
                    rows += "<thead>";
                    rows += "<tr>";
                    rows += "<th>Nombre</th>";
                    rows += "</tr>";
                    rows += "</thead>";
                    rows += "<tbody>";                    
                    for(var i = 1; i <= obj.length; i++){
                        rows += "<tr>";
                        rows += "<td width='50%'>" + obj[i - 1].marca_nombre + "</td>";
                        rows += "<td width='20%'><input class='btn-cancel borrar-marca' type='button' id='" + obj[i - 1].marca_nombre + "' value='Eliminar'/></td>";
                        rows += "</tr>";
                    }
                    rows += "</tbody>";
                    rows += "</table>";                        
                }
                $("#listado-marcas").html(rows);
            }
        });
    }

    var listarColores = function(){
        $.ajax({
            url: "../rutas_ajax/colores/listar.php?",
            type: "POST",
            success: function(r){
                obj = JSON.parse(r);
                var rows = "";
                if(obj.length != 0){
                    rows += "<table style='margin-top: 5%;'>";
                    rows += "<thead>";
                    rows += "<tr>";
                    rows += "<th>Nombre</th>";
                    rows += "<th>Código</th>";
                    rows += "</tr>";
                    rows += "</thead>";
                    rows += "<tbody>";                    
                    for(var i = 1; i <= obj.length; i++){
                        rows += "<tr>";
                        rows += "<td width='50%'>" + obj[i - 1].color_nombre + "</td>";
                        rows += "<td width='50%'>" + obj[i - 1].color_codigo + "</td>";
                        rows += "<td width='10%'><input class='btn-cancel borrar-color' type='button' id='" + obj[i - 1].color_nombre + "' value='Eliminar'/></td>";
                        rows += "</tr>";
                    }
                    rows += "</tbody>";
                    rows += "</table>";                        
                }
                $("#listado-colores").html(rows);
            }
        });
    }
    
    var listarLugares = function(){
        $.ajax({
            url: "../rutas_ajax/lugares/listar.php?",
            type: "POST",
            success: function(r){
                obj = JSON.parse(r);
                var rows = "";
                if(obj.length != 0){
                    rows += "<table style='margin-top: 5%;'>";
                    rows += "<thead>";
                    rows += "<tr>";
                    rows += "<th>Código</th>"
                    rows += "<th>Nombre</th>";
                    rows += "</tr>";
                    rows += "</thead>";
                    rows += "<tbody>";                    
                    for(var i = 1; i <= obj.length; i++){
                        rows += "<tr>";
                        rows += "<td width='20%'>" + obj[i - 1].lugar_id + "</td>";
                        rows += "<td width='20%'>" + obj[i - 1].nombre + "</td>";
                        rows += "<td width='10%'><input class='btn-cancel borrar-lugar' type='button' id='" + obj[i - 1].lugar_id + "' value='Eliminar'/></td>";
                        rows += "</tr>";
                    }
                    rows += "</tbody>";
                    rows += "</table>";                        
                }
                $("#listado-lugares").html(rows);
            }
        });
    }    

    //FUNCIONES PARA ELIMINAR MARCAS,COLORES Y LUGARES
    var eliminarMarca = function(id){
        $.ajax({
            url: "../rutas_ajax/marcas/eliminar.php?marca=" + id,
            type: "POST",
            success: function(r){
                if(r == 0){
                    //elimino
                    new PNotify({
                        title: 'Eliminar Marca',
                        text: 'Marca eliminada exitosamente.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });                    
                    listarMarcas();
                }else{
                    new PNotify({
                        title: 'Eliminar Marca',
                        text: 'Error al eliminar marca.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });                     
                }
            }
        });       
    } 

    var eliminarColor = function(id){
        $.ajax({
            url: "../rutas_ajax/colores/eliminar.php?color=" + id,
            type: "POST",
            success: function(r){
                if(r == 0){
                    //elimino
                    new PNotify({
                        title: 'Eliminar Color',
                        text: 'Color eliminado exitosamente.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });                    
                    listarColores();
                }else{
                    new PNotify({
                        title: 'Eliminar Color',
                        text: 'Error al eliminar color.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });                     
                }
            }
        });       
    }

    var eliminarLugar = function(id){
        $.ajax({
            url: "../rutas_ajax/lugares/eliminar.php?lugar=" + id,
            type: "POST",
            success: function(r){
                if(r == 0){
                    //elimino
                    new PNotify({
                        title: 'Eliminar Lugar',
                        text: 'Lugar eliminado exitosamente.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });                    
                    listarLugares();
                }else{
                    new PNotify({
                        title: 'Eliminar Lugar',
                        text: 'Error al eliminar lugar.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });                     
                }
            }
        });       
    }    
</script>