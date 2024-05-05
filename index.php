<?php
session_start();

// if user have not logged in
if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";

$userId = $_GET["userId"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi Agama</title>

    <script src="https://kit.fontawesome.com/095464096e.js" crossorigin="anonymous"></script>
    
    <style>
        input[type=text],[type= number],[type= date],[type=time],select{
            width: 100; 
            border: 2px solid black;
            border-radius: 10px;
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
    padding: 20px;
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
    margin-bottom: 20px;
}

.div-title .title {
    color: white;
}

.card-link {
    text-decoration: none;
    color: inherit;
}

.card {
    padding-inline: 20px;
    padding-block: 10px;
    width: 400px;
    border: 1px solid white;
    border-radius: 20px;
    background-color: #D9EDBF;

    display: flex;
    align-items: center;
    gap: 20px;
}
    </style>

</head>
<body>

    <header>
     <div class="app-name">Webkub</div>
     <nav>
        <a href="#"><i class="fa-solid fa-house"></i> Beranda</a>
        <a href="#"><i class="fa-solid fa-book"></i> Panduan</a>
        <a href="#"><i class="fa-solid fa-circle-info"></i> Tentang</a>
        <a href="#"><i class="fa-solid fa-phone-volume"></i> Kontak</a>
        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
     </nav>   
    </header>

    <div class="div-title">
        <h1 class="title">Selamat datang!</h1>
    </div>

    <div>
        <a class="card-link" href="pengaduan.php?userId=<?= $userId; ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <h3>Pengaduan</h3>
                    </div>
                    <div class="card-description">

                        <p>Masukkan pengaduan terkait masalah keagaman.</p>
                    </div>                
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-envelope-open-text fa-2xl"></i>
                </div>
            </div>    
        </a>
        
    </div>

</body>
</html>

