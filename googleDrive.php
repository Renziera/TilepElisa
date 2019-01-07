<?php
    
    function uploadDrive($nama_file, $data_file){
        //siapin body POST
        $data = array(
            'nama_file' => $nama_file,
            'data_file' => $data_file
        );

        //url ke Google App Script
        $url = 'https://script.google.com/macros/s/AKfycbxNDs3gcqEL5ecUuedyX5VkJZG_Ztfv1oGd7DikzVuWg9EA8j6A/exec';
        
        //inisialisasi curl
        $ch = curl_init();

        //Get the response from cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //Set the Url
        curl_setopt($ch, CURLOPT_URL, $url);
        //declare POST
        curl_setopt($ch, CURLOPT_POST, 1);
        //isi data
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //eksekusi
        $result = curl_exec ($ch);
        //tutup curl
        curl_close ($ch);

        if($result === false){
            return false;
        }

        //cek status
        $status = substr($result, 0, 6);
        if($status != 'sukses'){
            var_dump($result);
            return false;
        }

        $fileId = substr($result, 7);

        return $fileId;
    }
?>