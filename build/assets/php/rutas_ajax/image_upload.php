<?php
$retorno = 0;
<<<<<<< HEAD
=======
$nombre = $_GET["nombre"];
$folder = $_GET["folder"];
>>>>>>> 9ff6da2233d273938b978b14eece223a182b2353
if (isset($_FILES["file"]["type"])) {
    $validextensions = array(
        "png"
    );
<<<<<<< HEAD
    $nombre = "file2";
=======
>>>>>>> 9ff6da2233d273938b978b14eece223a182b2353
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension  = end($temporary);
    if (($_FILES["file"]["type"] == "image/png" || $_FILES["file"]["type"] == "image/jpg") && ($_FILES["file"]["size"] < 100000) && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
            $retorno = -3;
        } else {
<<<<<<< HEAD
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                //esto nunca pasara dado que se guardan con el id
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>El archivo ya existe.</b></span> ";
            } else {
                $sourcePath = $_FILES['file']['tmp_name']; // antiguo path
                $targetPath = "upload/" . $nombre.".png"; // nuevo path
                move_uploaded_file($sourcePath, $targetPath); // se mueve el archivo
                echo 1;
            }
=======
            // if (file_exists("upload/" . $_FILES["file"]["name"])) {
                //esto nunca pasara dado que se guardan con el id
                // echo $_FILES["file"]["name"] . " <span id='invalid'><b>El archivo ya existe.</b></span> ";
            // } else {
                $sourcePath = $_FILES['file']['tmp_name']; // antiguo path
                $targetPath = "../../img/".$folder."/" . $nombre.".png"; // nuevo path
                move_uploaded_file($sourcePath, $targetPath); // se mueve el archivo
                $retorno = 1;
            // }
>>>>>>> 9ff6da2233d273938b978b14eece223a182b2353
        }
    } else {
        $retorno = -1;
    }
}else{
    $retorno = -2;
}
<<<<<<< HEAD
echo $retorno
=======
echo $retorno;
>>>>>>> 9ff6da2233d273938b978b14eece223a182b2353
?>