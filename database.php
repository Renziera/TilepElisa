<?php

    $servername = "localhost";
    $username = "renziera_tilepelisa";
    $password = "5%pQhnDs@g8O#Zen";
    $database = "renziera_tilepelisa";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        echo "Koneksi database sukses<br>";
    }catch(PDOException $e){
        echo "Database error<br>";
        exit();
    }

    function getIndeksTerakhir($conn){
        $query = 'SELECT value FROM data_tilepan WHERE kunci="index_terakhir"';
        $querySQL = $conn->prepare($query);
        $querySQL->execute();
        $result = $querySQL->fetchall();
        return $result[0]['value'];
    }

    function setIndeksTerakhir($conn, $value){
        $updateQuery = 'UPDATE data_tilepan SET value = :value WHERE kunci="index_terakhir"';
        $query = $conn->prepare($updateQuery);
        $query->bindParam(':value', $value);
        $query->execute();
    }

    function isRunning($conn){
        $query = 'SELECT value FROM data_tilepan WHERE kunci="is_running"';
        $querySQL = $conn->prepare($query);
        $querySQL->execute();
        $result = $querySQL->fetchall();
        if($result[0]['value'] == 1){
            return true;
        }
        return false;
    }

    function setRunning($conn, $bool){
        if ($bool === true){
            $bool = 1;
        }else{
            $bool = 0;
        }
        $updateQuery = 'UPDATE data_tilepan SET value = :bool WHERE kunci="is_running"';
        $query = $conn->prepare($updateQuery);
        $query->bindParam(':bool', $bool);
        $query->execute();
    }

    function addTilepan($conn, $nama_file, $indeks, $fileId, $tanggal){
        $insertSQL = "INSERT INTO tilepan (nama_file, index_elisa, id_drive, tanggal) VALUES (:nama_file, :index_elisa, :id_drive, :tanggal)";
		$query = $conn->prepare($insertSQL);
        $query->bindParam(':nama_file', $nama_file );
        $query->bindParam(':index_elisa', $indeks );
        $query->bindParam(':id_drive', $fileId );
        $query->bindParam(':tanggal', $tanggal );
		$query->execute();
    }

?>