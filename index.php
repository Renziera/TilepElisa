<?php
    echo "<h1>Tilep Elisa Engine</h1><br><br>";
    require_once "database.php";

    date_default_timezone_set('Asia/Jakarta');

    $isRunning = isRunning($conn);
    if($isRunning){
        echo "Tilep sedang berjalan.<br>";
        echo "Indeks sekarang: " . getIndeksTerakhir($conn);
        exit();
    }else{
        echo "Tilep sedang tidak berjalan.<br>";
        echo "Indeks terakhir: " . getIndeksTerakhir($conn);
    }

    echo "Server time: " . date();

?>