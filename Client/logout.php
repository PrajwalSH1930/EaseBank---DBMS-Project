<?php
session_start();
include 'connection.php';
$conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
session_destroy();
unset($_SESSION['valid']);
header('Location:../index.php');
?>