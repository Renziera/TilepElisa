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
        Batas upload 
        <input type="date" name="date">
        sampai
        <input type="date" name="">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="Cari">
    </form>
    <div style="height:550px;overflow:auto">
        <table>
            <tr>
                <th>Nama file</th>
                <th>Link download</th>
            </tr>
       
<?php
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        if(strlen($search) < 3){
            echo "Query pencarian minimal 3 huruf.";
        }else{
            require_once "database.php";
            incrementSearchCount($conn);
            $result = searchTilepan($conn, $search);
            
            if(sizeof($result) === 0){
                echo "Tidak ditemukan.";
            }

            for ($i = sizeof($result) - 1; $i > -1 ; $i--) { 
                echo "<tr>";
                echo "<td>";
                echo $result[$i]['nama_file'];
                echo "</td>";
                echo "<td>";
                echo '<button type="button" onclick="window.open(\'http://adf.ly/20994703/https://renziera.web.id/tilepanelisa/?database_id=';
                echo $result[$i]['id'];
                echo '\',\'_blank\')">Tilep</button>';
                echo "</td>";
                echo "</tr>";
            }
        }  
    }  
?>
        </table>
    </div>
</body>
</html>