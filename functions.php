<?php 

//connect to database
$conn = mysqli_connect("localhost", "root", "", "sikub");

function query($query) {
    global $conn;

    try {
        // query data
        $result = mysqli_query($conn, $query);

        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;

    } catch (Exception $e) {
        // echo $e;
        echo mysqli_error($conn);
    }

}

function add($data) {
    global $conn;

    $kabkota = htmlspecialchars($data["kabupaten/kota"]);
    $tanggal = htmlspecialchars($data["tanggalPengaduan"]);
    $permasalahan = htmlspecialchars($data["permasalahan"]);
    $kabkotaId = (int)query("SELECT id FROM kabupaten WHERE nama = '$kabkota'")[0]["id"];
    $pelaporId = (int)$data["userId"];

    // upload poster
    $dokumen = upload();

    $query = "INSERT INTO daftar_kasus_keagamaan (permasalahan, tanggal, kabupaten_id, pelapor_id, dokumen)
                VALUES
                ('$permasalahan', '$tanggal', $kabkotaId, $pelaporId, '$dokumen')
                ";
    
    try {
        mysqli_query($conn, $query);
        echo "<script>
                alert('Aduan anda sudah diterima.')
                document.location.href = 'index.php?userId=$pelaporId'
            </script>";
    } catch (Exception $e) {
        echo "Terjadi kesalahan!";
        echo mysqli_error($conn);
    }
}

function upload() {
    $fileName = $_FILES["dokumen"]["name"];
    $fileSize = $_FILES["dokumen"]["size"];
    $tmpName = $_FILES["dokumen"]["tmp_name"];
    $error = $_FILES["dokumen"]["error"];

    // if user don't upload a poster, use default image
    if ($error === 4) {
        return '-';
    }

    // uploaded file must be an image
    $validFileExtensions = ["pdf", "doc"];
    $extensionFile = explode('.', $fileName);
    $extensionFile = end($extensionFile);
    $extensionFile = strtolower($extensionFile);

    if (!in_array($extensionFile, $validFileExtensions)) {
        echo "<script>
                alert('The file you are uploaded is not an .pdf or .doc');
            </script>";
        return '-';
    }

    // uploaded document size is not too large
    if ($fileSize > 1000000) {
        echo "<script>
                alert('The file you are uploaded is too large');
            </script>";
        return '-';
    }

    // generate a new file name to prevent the same name users file name
    $newFileName = uniqid();
    $newFileName .= ".";
    $newFileName .= $extensionFile;

    move_uploaded_file($tmpName, './docs/' . $newFileName);

    return $newFileName;
}

function register($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $passwordConfirmation = mysqli_real_escape_string($conn, $data["password-confirmation"]);

    // check email availability
    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
    
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Email sudah terdaftar!');
            </script>";
        return false;
    }

    // check password confirmation
    if ($password !== $passwordConfirmation) {
        echo "<script>
                alert('Password dan konfirmasi password tidak sesuai!');     
            </script>";

        return false;
    }

    // encrypt the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // add new user to db
    $query = "INSERT INTO user (nama, email, password) VALUES ('$nama', '$email', '$password')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>