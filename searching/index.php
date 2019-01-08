<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tilep Elisa</title>
</head>
<body>
    <form action="#tilep" method="post">
        <input type="text" name="search" placeholder="Masukkan kata kunci pencarian. . ." maxlength="30">
        Batas upload dari
        <input type="date" name="dateFrom">
        sampai
        <input type="date" name="dateUntil">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="Cari">
    </form>
    <div style="height:550px;overflow:auto">
        <table>
            <tr>
                <th>Nama file</th>
                <th>Link download</th>
                <th>Diupload tanggal</th>
            </tr>
       
<?php
    $need = true;
    require_once "database.php";

    function showResult($result){
        if(sizeof($result) === 0){
            echo "Tidak ditemukan.";
        }

        for ($i = sizeof($result) - 1; $i > -1 ; $i--) { 
            echo "<tr>";
            echo "<td>";
            echo $result[$i]['nama_file'];
            echo "</td>";
            echo "<td>";
            echo '<button type="button" onclick="window.open(\'http://adf.ly/20994703/https://renziera.web.id/tilepanelisa/?key=';
            echo mt_rand(1000, 1000000) . 'QE8h'. mt_rand(1000000, 9999999) .'sda'. mt_rand(100, 999) .'&kleng=';
            echo $result[$i]['id'];
            echo '&sign=isekaiMipa\',\'_blank\')">Tilep</button>';
            echo "</td>";
            echo "<td>";
            $tanggal = $result[$i]['tanggal'];
            $tahun = substr($tanggal, 0, 4);
            $bulan = substr($tanggal, 4, 2);
            $hari = substr($tanggal, 6, 2);
            echo $hari . '-' . $bulan . '-' . $tahun;
            echo "</td>";
            echo "</tr>";
        }
    }

     if(!empty($_POST['dateFrom'])){
        $dateFrom = $_POST['dateFrom'];
        $dateFrom = str_replace('-', '', $dateFrom);
        if(!is_numeric($dateFrom)){
            $dateFrom = 0;
        }

        if(empty($_POST['search']) && empty($_POST['dateUntil'])){
            $need = false;
            $result = limitTanggal($conn, $dateFrom, 99999999);
            showResult($result);
        }
    }

    if(!empty($_POST['dateUntil']) && $need){
        $dateUntil = $_POST['dateUntil'];
        $dateUntil = str_replace('-', '', $dateUntil);
        if(!is_numeric($dateUntil)){
            $dateUntil = 99999999;
        }

        if(empty($_POST['search']) && empty($_POST['dateFrom'])){
            $need = false;
            $result = limitTanggal($conn, 0, $dateUntil);
            showResult($result);
        }

        if(empty($_POST['search'])){
            $need = false;
            $result = limitTanggal($conn, $dateFrom, $dateUntil);
            showResult($result);
        }
    }
    if(!empty($_POST['search']) && $need){
        $search = $_POST['search'];
        if(strlen($search) < 3){
            echo "Query pencarian minimal 3 huruf.";
        }else{
            $need = false;
            if(!empty($_POST['dateUntil']) && !empty($_POST['dateFrom'])){
                $result = searchNamaTanggal($conn, $search, $dateFrom, $dateUntil);
            }elseif(!empty($_POST['dateUntil'])){
                $result = searchNamaTanggal($conn, $search, 0, $dateUntil);
            }elseif(!empty($_POST['dateFrom'])){
                $result = searchNamaTanggal($conn, $search, $dateFrom, 99999999);
            }else{
                $result = searchTilepan($conn, $search);
            }
            showResult($result);
        }  
    }

    if($need === false){
        incrementSearchCount($conn);
    }
?>
        </table>
    </div>
</body>
</html>