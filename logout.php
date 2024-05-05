<?php 

session_start();

// make sure all session is vanished :)
$_SESSION = [];
session_unset();

session_destroy();

// delete cookies
setcookie("id", "", time() - 3600);
setcookie("key", "", time() - 3600);

header("Location: login.php");

?>