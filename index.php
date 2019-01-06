<?php

    $url = 'https://elisa.ugm.ac.id/user/archive/download/519203';



    //inisialisasi curl
    $ch = curl_init();
    //pasang url
    curl_setopt($ch, CURLOPT_URL, $url);
    //ngambil result
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    //ngambil header juga, untuk nama file
    curl_setopt($ch, CURLOPT_HEADER, true);
    //timeout 20 detik
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    //eksekusi curl
    $response = curl_exec($ch);

    if($response === false){
        //curl nya error
        echo "cUrl gagal";
        exit();
    }

    if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == '404'){
        //file nya gak ada, antara indeks blm keisi atau dihapus
        echo "404 Not found";
        exit();
    }

    if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) != '200'){
        //tidak OK
        echo "Result gagal";
        var_dump($response);
        exit();
    }
    
    //pisahin header dan body (data filenya)
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    
    //dapetin nama file (regex nyolong)
    $regexNama = '/^Content-Disposition: .*?filename=(?<f>[^\s]+|\x22[^\x22]+\x22)\x3B?.*$/m';
    if (preg_match($regexNama, $header, $mDispo)){
        $filename = trim($mDispo['f'],' ";');
    }else{
          $filename = 'fileTanpaNama';
    }

    //simpan file
    file_put_contents('tilepan/' . $filename, $body);

    //tutup curl handler
    curl_close($ch);
    echo "Done";
?>