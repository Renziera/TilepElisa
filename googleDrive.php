<?php
    
    function uploadDrive($nama_file, $data_file){
        //siapin body POST
        $data = array(
            'nama_file' => $nama_file,
            'data_file' => $data_file
        );

        //siapin request
        $options = array(
            'http' => array(
                'header' => "",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        //url ke Google App Script
        $url = 'https://script.google.com/macros/s/AKfycbxNDs3gcqEL5ecUuedyX5VkJZG_Ztfv1oGd7DikzVuWg9EA8j6A/exec';
    
        //tembak request
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

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