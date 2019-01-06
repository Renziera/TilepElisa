<?php
    echo "<h1>Tilep Elisa Engine</h1><br><br>";
    require_once "elisa.php";
    require_once "googleDrive.php";
    require_once "database.php";

    date_default_timezone_set('Asia/Jakarta');
    //cek supaya loop tidak dobel
    $isRunning = isRunning($conn);
    if($isRunning){
        echo "Tilep sedang berjalan.<br>";
        echo "Indeks sekarang: " . getIndeksTerakhir($conn);
        exit();
    }

    echo "Jangan menutup browser hingga proses selesai.<br>";

    //tiap run iterasi dibatasi
    $iterasi = 10;
    echo "Query sebanyak $iterasi kali <br><br>";

    setRunning($conn, true);
    $indeks = getIndeksTerakhir($conn);
    $indeksGagal = 0;

    for ($i=$iterasi; $i > 0; $i--) {
        //memang indeks masih kosong
        if($indeksGagal > 5){
            break;
        }
        echo "<br><br><br>";
        echo "Mencoba download $indeks <br>";
        $file = downloadElisa($indeks);
        
        if($file === false){
            echo "Gagal download $indeks <br>";
            $indeksGagal++;
            incrementIndeks($conn);
            $indeks++;
            continue;
        }
        echo "Berhasil download $indeks <br>";

        $nama_file = $file['nama_file'];

        echo "Mencoba upload $indeks $nama_file ke Google Drive <br>";
        $fileId = uploadDrive($nama_file, $file['data_file']);

        if($fileId === false){
            echo "Gagal upload ke drive";
            $indeksGagal++;
            incrementIndeks($conn);
            $indeks++;
            continue;
        }
        echo "Berhasil upload $indeks $nama_file ke Google Drive dengan id $fileId <br>";

        addTilepan($conn, $nama_file, $indeks, $fileId, date('Ymd'));
        echo "File $indeks berhasil ditambahkan ke database. <br>";
        incrementIndeks($conn);
        $indeks++;
    }

    setRunning($conn, false);
    echo "<br><br><br>";
    echo "Proses selesai. <br>"
?>