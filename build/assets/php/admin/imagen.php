<html>
<head>
<title>Ajax Image Upload Using PHP and jQuery</title>
<link rel="stylesheet" href="style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div class="main">
<h1>Ajax Image Upload</h1><br/>
<hr>
<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
<div id="image_preview"><img id="previewing" src="noimage.png" /></div>
<hr id="line">
<div id="selectImage">
<label>Select Your Image</label><br/>
<input type="file" name="file" id="file" required />
<a href="#" type="submit" id="boton" value="Upload" class="submit">CLICK</a>
</div>
</form>
</div>
<h4 id='loading' >loading..</h4>
<div id="message"></div>
</body>
</html>

<script>

    $(document).ready(function(e) {
        $("#boton").on('click', (function() {
            var x = document.getElementById("file");
            file = x.files[0];
            if(file != undefined){
                $("#message").empty();
                $('#loading').show();
                var formData = new FormData();
                formData.append('file', file, 'test.png');
                $.ajax({
                    url: "../rutas_ajax/image_upload.php?folder=productos&nombre=file", // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    success: function(data) // A function to be called if request succeeds
                    {
                        $('#loading').hide();
                        $("#message").html(data);
                    }
                });
            }else{
                alert("seleccione un archivo porfavor");
            }
        }));

        // Function to preview image after validation
        $(function() {
            $("#file").change(function() {
                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/png"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
<<<<<<< HEAD
                    $('#previewing').attr('src', 'noimage.png');
                    $("#message").html("<p id='error'>Porfavor seleccione un archivo válido de imagen</p>" + "<h4>Note</h4>" + "<span id='error_message'>Solamente imagenes .png son permitidas</span>");
=======
                    $('#previewing').attr('src', '../../img/productos/default.png');
                    $('#previewing').attr('width', 300)
                    $('#previewing').attr('height', 200)
                    $("#message").html("<p id='error'>Porfavor seleccione un archivo valido de imagen</p>" + "<h4>Note</h4>" + "<span id='error_message'>Solamente imagenes .png son permitidas</span>");
>>>>>>> 9ff6da2233d273938b978b14eece223a182b2353
                    return false;
                } else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $("#file").css("color", "green");
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '250px');
            $('#previewing').attr('height', '230px');
        };
    });
</script>