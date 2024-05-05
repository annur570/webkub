<?php

session_start();

require 'functions.php';

// check cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // get username in db
    $result = mysqli_query($conn, "SELECT email FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // check cookie and username
    if ($key === hash("sha256", $row["email"])) {
        $_SESSION["isLoggedIn"] = true;
    }
}

// if user have logged in
if (isset($_SESSION["isLoggedIn"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if (mysqli_num_rows($result) === 1) {
        // password check
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["isLoggedIn"] = true;

            // check remember me
            if (isset($_POST["remember"])) {
                // set cookie
                setcookie("id", $row["id"], time() + 60); // set cookie for 60 seconds
                setcookie("key", hash("sha256", $row["email"]), time() + 60); // set cookie for 60 seconds
            }

            header("Location: index.php?userId=" . $row["id"]);
            exit;
        }
    }

    $error = true;
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
        input[type=email],[type= number],[type= date],[type=time],[type=password],select {
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

        input[type=email],input[type=password],
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

        .div-remember {
            margin-bottom: 16px;
        }
    </style>

</head>
<body>
    
    <div class="container">
    <img src="logo.png" width="200" alt="">
        <h1>Sistem Informasi KUB</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="div-remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" id="inline-label">Remember me</label>
            </div>
            <button type="submit" name="login">Masuk</button>
        </form>
        <p>Belum registrasi? <a href="register.php">register</a>.</p>
    </div>

</body>
</html>

