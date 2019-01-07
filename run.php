<?php
    //Hanya khusus dijalankan di cron job
    //Karena kalo browser reset koneksi, proses terminasi
    require_once "elisa.php";
    require_once "googleDrive.php";
    require_once "database.php";

    date_default_timezone_set('Asia/Jakarta');
    //cek supaya loop tidak dobel
    $isRunning = isRunning($conn);
    if($isRunning){
        exit();
    }

    //tiap run iterasi dibatasi
    $iterasi = 10;

    setRunning($conn, true);
    $indeks = getIndeksTerakhir($conn);
    $indeksKosong = 0;

    for ($i=$iterasi; $i > 0; $i--) {
        
        $file = downloadElisa($indeks);
        
        if($file === false){
            $indeksKosong++;
            $indeks++;
            continue;
        }

        $nama_file = $file['nama_file'];

        $fileId = uploadDrive($nama_file, $file['data_file']);

        if($fileId === false){
            $indeksKosong++;
            $indeks++;
            continue;
        }

        addTilepan($conn, $nama_file, $indeks, $fileId, date('Ymd'));
        
        $indeks++;
        $indeksKosong = 0;
    }

    setIndeksTerakhir($conn, ($indeks - $indeksKosong));
    setRunning($conn, false);
?>