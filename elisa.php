<?php

    function downloadElisa($indeks){
        $url = "https://elisa.ugm.ac.id/user/archive/download/$indeks";

        //inisialisasi curl
        $ch = curl_init();
        //pasang url
        curl_setopt($ch, CURLOPT_URL, $url);
        //ngambil result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        //ngambil header juga, untuk nama file
        curl_setopt($ch, CURLOPT_HEADER, true);
        //cuma header saja
        curl_setopt($ch, CURLOPT_NOBODY, true);
        //timeout 20 detik
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        //eksekusi curl
        $response = curl_exec($ch);

        if($response === false){
            //curl nya error
            echo "cUrl gagal";
            return false;
        }

        if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == '404'){
            //file nya gak ada, antara indeks blm keisi atau dihapus
            echo "404 Not found";
            return false;
        }

        if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) != '200'){
            //tidak OK
            echo "Result gagal";
            var_dump($response);
            return false;
        }

        //dapetin nama file
        $filename = strstr($response, 'filename="');
        if ($filename === false){
            $filename = 'fileTanpaNama';
        }else{
            $filename = explode('"', $filename, 3)[1];
        }

        //tutup curl handler
        curl_close($ch);

        return $filename;
    }
?>