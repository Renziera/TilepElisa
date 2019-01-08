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
    }  

    function searchTilepan($conn, $katakunci){
        $katakunci = "%".$katakunci."%";
        $searchSQL = 'SELECT nama_file, id FROM tilepanku WHERE nama_file LIKE :katakunci';
        $query = $conn->prepare($searchSQL);
        $query->bindParam(':katakunci', $katakunci);
        $query->execute();
        $result = $query->fetchall();
        return $result;
    }

    function limitTanggal($conn, $tanggalAwal, $tanggalAkhir){

    }

    function incrementSearchCount($conn){
        $updateQuery = 'UPDATE data_tilepan SET value = value + 1 WHERE kunci="search_queries"';
        $query = $conn->prepare($updateQuery);
        $query->execute();
    }

    function incrementDownloadCount($conn){
        $updateQuery = 'UPDATE data_tilepan SET value = value + 1 WHERE kunci="downloads_count"';
        $query = $conn->prepare($updateQuery);
        $query->execute();
    }
?>