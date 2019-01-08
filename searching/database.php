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
        $searchSQL = 'SELECT nama_file, id, tanggal FROM tilepanku WHERE nama_file LIKE :katakunci';
        $query = $conn->prepare($searchSQL);
        $query->bindParam(':katakunci', $katakunci);
        $query->execute();
        $result = $query->fetchall();
        return $result;
    }

    function limitTanggal($conn, $tanggalAwal, $tanggalAkhir){
        $searchSQL = 'SELECT nama_file, id, tanggal FROM tilepanku WHERE tanggal >= :tanggalAwal AND tanggal <= :tanggalAkhir';
        $query = $conn->prepare($searchSQL);
        $query->bindParam(':tanggalAwal', $tanggalAwal);
        $query->bindParam(':tanggalAkhir', $tanggalAkhir);
        $query->execute();
        $result = $query->fetchall();
        return $result;
    }

    function searchNamaTanggal($conn, $katakunci, $tanggalAwal, $tanggalAkhir){
        $katakunci = "%".$katakunci."%";
        $searchSQL = 'SELECT nama_file, id, tanggal FROM tilepanku WHERE nama_file LIKE :katakunci AND tanggal >= :tanggalAwal AND tanggal <= :tanggalAkhir';
        $query = $conn->prepare($searchSQL);
        $query->bindParam(':katakunci', $katakunci);
        $query->bindParam(':tanggalAwal', $tanggalAwal);
        $query->bindParam(':tanggalAkhir', $tanggalAkhir);
        $query->execute();
        $result = $query->fetchall();
        return $result;
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