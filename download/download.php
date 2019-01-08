<?php
    if(!isset($_GET['database_id'])){
        echo "Request tidak valid >_<";
        exit();
    }

    $id = $_GET['database_id'];

    if(!is_numeric($id)){
        exit();
    }

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
    }  

    $querySQL = 'SELECT indeks_elisa FROM tilepanku WHERE id = :id';
    $query = $conn->prepare($querySQL);
    $query->bindParam(':id', $id);
    $query->execute();
    $result = $query->fetchall();

    $indeks = $result[0]['indeks_elisa'];

    header("Location: https://elisa.ugm.ac.id/user/archive/download/$indeks");
?>