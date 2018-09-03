<?php
if (isset($_FILES["file"]["type"])) {
    $validextensions = array(
        "png"
    );
    $nombre = "file2";
    $temporary       = explode(".", $_FILES["file"]["name"]);
    $file_extension  = end($temporary);
    if (($_FILES["file"]["type"] == "image/png") && ($_FILES["file"]["size"] < 100000) && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>El archivo ya existe.</b></span> ";
            } else {
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = "upload/" . $nombre.".png"; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                echo "<span id='success'>Imagen guardada exitosamente...!!</span><br/>";
            }
        }
    } else {
        echo "<span id='invalid'>Archivo inválido<span>";
    }
}
?>