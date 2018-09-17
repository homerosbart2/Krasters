<?php
$retorno = 0;
$nombre = $_GET["nombre"];
$folder = $_GET["folder"];
$type = $_GET["type"];
if (isset($_FILES["file"]["type"])) {
    $validextensions = array(
        "jpeg",
        "jpg",
        "png"
    );
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension  = end($temporary);
    if (($_FILES["file"]["size"] < 1000000) && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
            $retorno = -3;
        } else {
            // if (file_exists("upload/" . $_FILES["file"]["name"])) {
                //esto nunca pasara dado que se guardan con el id
                // echo $_FILES["file"]["name"] . " <span id='invalid'><b>El archivo ya existe.</b></span> ";
            // } else {
                $sourcePath = $_FILES['file']['tmp_name']; // antiguo path
                $targetPath = "../../img/".$folder."/" . $nombre.".".$type; // nuevo path
                move_uploaded_file($sourcePath, $targetPath); // se mueve el archivo
                $retorno = 1;
            // }
        }
    } else {
        $retorno = -1;
    }
}else{
    $retorno = -2;
}

echo $file_extension;
echo $retorno
?>