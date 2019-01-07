<?php

    $servername = "localhost";
    $username = "renziera_tilepelisa";
    $password = "5%pQhnDs@g8O#Zen";
    $database = "renziera_tilepelisa";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }catch(PDOException $e){
        echo "Database error<br>";
        exit();
    }  

    function searchTilepan($conn, $katakunci){
        $katakunci = "%".$katakunci."%";
        $searchSQL = 'SELECT nama_file, id_drive FROM tilepan WHERE nama_file LIKE :katakunci';
        $query = $conn->prepare($searchSQL);
        $query->bindParam(':katakunci', $katakunci);
        $query->execute();
        $result = $query->fetchall();
        return $result;
    }
?>