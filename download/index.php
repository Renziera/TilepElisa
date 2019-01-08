
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tilep Tugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php
    if(!isset($_GET['kleng'])){
        echo "<h1>Request tidak valid >_<</h1>";
        exit();
    }
    $id = $_GET['kleng'];

    if(!is_numeric($id)){
        echo "<h1>Request tidak valid >_<</h1>";
        exit();
    }
?>
    <h1>Terima kasih telah menggunakan Tilep Elisa :D</h1>
    <h3>Cek koneksi anda apabila file belum terunduh dalam 10 detik</h3>
    Silahkan tutup laman ini setelah file terunduh
    <script type="text/javascript">
        window.onload = function() {
            window.location.href = "download.php?database_id=<?php echo $id?>";
        }
    </script>
</body>
</html>
