<?php
include("connection.php");
session_start();
$conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
$acc_id = $_SESSION['acc_id'];
$sql = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id=$acc_id");

while($res=mysqli_fetch_assoc($sql)){
    $acc_id = $res['acc_id'];
}
if (isset($_POST['payBtn'])) {
    $payeeName = $_POST['payeeName'];
    $payAmount = $_POST['payAmount'];
    $note = $_POST['note'];
    $payRes = mysqli_query($conn, "INSERT INTO payments(acc_id,payment_to,pay_amt,notes) VALUES ('{$acc_id}','{$payeeName}','{$payAmount}','{$note}');") or die("Error");
    header("Location:transfer.php");
}

if(isset($_POST['doneBtn'])){
    $id = $_POST['doneBtn'];
    mysqli_query($conn, "DELETE FROM payments WHERE pay_id=$id");
    header("Location:transfer.php");
}
                    