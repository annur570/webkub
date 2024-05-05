<?php

require 'functions.php';

if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo "<script>
                alert('User berhasil ditambahkan');
            </script>";

        header("Location: login.php");
        exit;
    } else {
        echo "<script>
                alert('Gagal menambahkan user');
            </script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi Agama</title>
    
    <style>
        input[type=email],[type= number],[type= text],[type=password] {
            width: 100; 
            border: 1px solid black;
            border-radius: 10px;
        }

        body {
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color:green;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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
    </style>

</head>
<body>
    
    <div class="container">
    <img src="logo.png" width="200" alt="">
        <h1>Sistem Informasi KUB</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password-confirmation" placeholder="Konfirmasi password" required>
            <button type="submit" name="register">Registrasi</button>
        </form>
        <p>Sudah memiliki akun? <a href="login.php">masuk</a>.</p>
    </div>

</body>
</html>

