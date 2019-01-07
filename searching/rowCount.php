<?php
    $servername = "localhost";
    $username = "renziera_tilepelisa";
    $password = "5%pQhnDs@g8O#Zen";
    $database = "renziera_tilepelisa";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $rowCountQuery = 'SELECT COUNT(nama_file) FROM tilepanku';
        $query = $conn->prepare($rowCountQuery);
        $query->execute();
        $result = $query->fetchall();
        echo $result[0]['COUNT(nama_file)'];
    }catch(PDOException $e){
        echo "DB Err";
    }  
    
?>