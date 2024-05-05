<?php

session_start();

// if user have not logged in
if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";


$userId = $_GET["userId"];

$daftarKabupaten = query("SELECT * FROM kabupaten");

if (isset($_POST["submit"])) {
    // var_dump($_POST); 
    // var_dump($_FILES); 
    // die;

    add($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://kit.fontawesome.com/095464096e.js" crossorigin="anonymous"></script>

    <style>
        input[type=text],[type= number],[type= date],[type=time],select{
            width: 100; 
        }  

        body {
            font-family: Arial, sans-serif;
            background-color:green;
            padding-block: 10px;
            padding-inline: 20px;
        }

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav {
    display: flex;
    gap: 16px;
}

nav a {
    text-decoration: none;
    color: white;
}

.app-name {
    color: white;
}

.container {
    max-width: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
}

input,
select,
textarea {
    width: 100%;
    margin-bottom: 10px;
    padding: 8px;
    box-sizing: border-box;
    display: inline-block; 
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.div-title {
    margin-top: 50px;
}

.div-title .title {
    color: white;
}

.div-pengaduan p {
    color: white;
}

.label-tanggal-pengaduan {
    color: white;
}

    </style>
</head>
<body>
    <header>
    <div class="app-name">Webkub</div>
     <nav>
        <a href="index.php"><i class="fa-solid fa-house"></i> Beranda</a>
        <a href="#"><i class="fa-solid fa-book"></i> Panduan</a>
        <a href="#"><i class="fa-solid fa-circle-info"></i> Tentang</a>
        <a href="#"><i class="fa-solid fa-phone-volume"></i> Kontak</a>
        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
     </nav>   
    </header>

    <div class="div-title">
        <h1 class="title">Pengaduan</h1>
    </div>

    <div class="container">
        <div class="div-pengaduan">
            <p>Masukkan pengaduan masalah tentang keagamaan. Sertakan juga data-data pendukung yang valid.</p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="userId" value="<?= $userId; ?>">
            <select name="kabupaten/kota" id="">
                <option value="pilih">Pilih Kabupaten/Kota</option>
                <?php foreach ($daftarKabupaten as $kabupaten) { ?>
                <option value="<?= $kabupaten["nama"]; ?>"><?= $kabupaten["nama"]; ?></option>
                <?php } ?>
            </select>

            <label for="tanggalPengaduan" class="label-tanggal-pengaduan">Tanggal Pengaduan</label>
            <input type="date" name="tanggalPengaduan" id="tanggalPengaduan">

            <textarea name="permasalahan" placeholder="Tulis permasalahan" rows="4" required></textarea>

            <input type="file" name="dokumen" id="dokumen">
            
            <button type="submit" name="submit">Kirim</button>
        </form>
    </div>
</body>
</html>