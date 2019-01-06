<?php
    echo "<h1>Tilep elisa engine</h1><br><br>";
    require_once "elisa.php";
    require_once "googleDrive.php";
    require_once "database.php";

    $indeks = 519202;
    echo getIndeksTerakhir($conn) . "<br>";
    incrementIndeks($conn);
    echo getIndeksTerakhir($conn). "<br>";
    echo isRunning($conn). "<br>";
    setRunning($conn, true);
    echo isRunning($conn). "<br>";
    addTilepan($conn, 'Dummy name', 123, 'Dummy Id', 20190101);
    /*
    $file = downloadElisa($indeks);
    
    if($file === false){
        echo "Gagal download $indeks";
        //break;
        exit();
    }
    
    $fileId = uploadDrive($file['nama_file'], $file['data_file']);

    if($fileId === false){
        echo "Gagal upload ke drive";
        exit();
    }

    var_dump($fileId);

?>