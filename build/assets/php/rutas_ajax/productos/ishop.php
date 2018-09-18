<?php
    $link = pg_connect("host=localhost dbname=TIENDA user=normal_user password=%normalNormal2018%");
    $correct = 0;
    while($correct == 0){
        $code = rand(100000,999999);
        $query = "SELECT codigo FROM Codigos WHERE codigo = $code";        
        $result = pg_query($link, $query);
        if($result){
            if(pg_num_rows($result) == 0){
                $row = pg_fetch_assoc($result);
                $retorno = $row["existencia"];
                $query = "INSERT INTO Codigos VALUES ($code,1)";
                $result = pg_query($link, $query);
                $correct = 1;
            }
        }
    }
    pg_close($link);
    echo $code;
?>