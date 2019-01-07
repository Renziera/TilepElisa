<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tilep Elisa</title>
</head>
<body>
    <form action="#tilep" method="post">
        <input type="text" name="search">
        <input type="submit" value="Cari">
    </form>
    <br>
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
            $result = searchTilepan($conn, $search);

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>";
                echo $row['nama_file'];
                echo "</td>";
                echo "<td>";
                echo '<button type="button">Tilep</button>';
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