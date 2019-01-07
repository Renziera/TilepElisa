<?php
    $servername = "localhost";
    $username = "renziera_tilepelisa";
    $password = "5%pQhnDs@g8O#Zen";
    $database = "renziera_tilepelisa";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $query = 'SELECT value FROM data_tilepan WHERE kunci="downloads_count"';
        $querySQL = $conn->prepare($query);
        $querySQL->execute();
        $result = $querySQL->fetchall();
        echo $result[0]['value'];
    }catch(PDOException $e){
        echo "DB Err";
    }  
    
?>