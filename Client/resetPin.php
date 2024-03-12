<?php
    session_start();
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    if(isset($_POST['reset'])){
        $newPin = $_POST['pin'];
        $confPin = $_POST['confPin'];
        $email = $_SESSION['email'];
        if ($newPin == $confPin) {
        $sql = "UPDATE accounts SET pwd='{$newPin}' WHERE email= '{$email}'";
            mysqli_query($conn,$sql);
            echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
            <p>Account PIN updated successfully!.</p></div>";
            sleep(5);
            unset($_SESSION['email']);
            header("Location:../index.php");
        }else{
            echo "<div class='error_msg' id='toast'><i class='bx bx-x-circle msg-icon'></i>
            <p>Something went wrong!, Please try again later. Or check credentials.</p></div>";
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EaseBank &mdash; Reset Pin</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/interface.css">
    <link rel="stylesheet" href="../css/queries.css">
    <link rel="shortcut icon" href="images/xing-logo-2447.png" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    body {
        background: #f5f5f5;
    }

    <?php include '../css/styles.css';
    include '../css/animation.css';
    ?>
    </style>
</head>

<body
    style="background: linear-gradient(to left bottom, #fff 50%, #6f42c1);height:100vh;display:flex;align-items:center;justify-content:center;">
    <div class="resetPin">
        <header>
            <h1>Reset Account PIN</h1>
        </header>
        <div class="details">
            <form action="" method="post" autocomplete="off">
                <p>Enter a new password for EaseBank.</p>
                <label for="">New PIN</label>
                <input type="password" name="pin" required>
                <label for="">Confirm PIN</label>
                <input type="password" name="confPin" required>
                <button name="reset">Reset PIN</button>
                <a href="login.php" class="regLink">Back to Login</a>
            </form>
        </div>
    </div>
</body>

</html>