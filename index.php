<?php
    require_once "elisa.php";
    require_once "googleDrive.php";
    //require_once "database.php";

    $indeks = 519202;

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