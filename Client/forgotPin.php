<?php
    session_start();
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
?>

<!DOCTYPE html>
<html lang="en">

<?php
if (isset($_POST['reset'])) {
     $OTP = rand(1000, 9999);
     $email = $_POST['email'];
    $_SESSION['OTP'] = $OTP;
    $_SESSION['email'] = $email;
    $sql = mysqli_query($conn, "SELECT email FROM accounts WHERE email = '$email'");
    if (mysqli_num_rows($sql) == 0) {
        echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i>
            <p>Error Occurred!, Invalid Email address!</p>
            </div>";
    } else {
        $subject = "Reset Your EaseBank PIN";
        $sql=mysqli_query($conn,"SELECT * FROM accounts WHERE email = '$email'");
        while($row=mysqli_fetch_assoc($sql)){
            $name = $row['acc_name'];
        }
        $message = "<html>
  <head>
    <style>
      .mailbox {
        background-color: #f5f5f5;
        width: 250px;
        margin: 18px auto;
        padding: 0 16px 24px;
        border-top: 3px solid #6f42c1;
        border-radius: 4px;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 2px rgba(0, 0, 0, 0.2);
      }
      .mailbox h2 {
        text-align: center;
        font-weight: 500;
      }
      .text {
        text-align: center;
        margin-bottom: 24px;
      }
      .details {
        margin: 12px auto;
        text-align: center;
        width: 240px;
        font-size: 14px;
      }
      img {
        width: 48px;
        height: 48px;
      }
      .copy {
        text-align: center;
        margin: 12px auto;
        width: 240px;
        font-size: 14px;
      }
      h1{
        margin-top:24px;
        font-weight: 500;
        color:#f5f5f5;
        text-align: center;
      }
      span{
        color:#85bb65;
      }
    </style>
    </head>
      <body>
      <p>Hi ,$name</p>
        <p>Greetings from the EaseBank!</p>
        <p>We got a request to reset your EaseBank password.</p>
        <div class='mailbox'>
            <h2>Your OTP is, {$OTP}</h2>
        </div>
        <p class='text'>
        If you ignore this message, your password will not be changed. If you didn't request a password reset, let us know.
      </p>
      <p class='details'>
      This email was sent to {$email} because you recently requested for reset password of
      EaseBank Account.
    </p>
      </body>
    </html>";
        $headers = "From: EaseBank <easebank.princeinc@gmail.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($email, $subject, $message, $headers);
        echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
        <p>OTP has successfully sent to $email. Check your provided email.</p>
        </div>";
    }
}
if(isset($_POST['otp'])){
    $pin = $_POST['pin1'] . $_POST['pin2'] . $_POST['pin3'] . $_POST['pin4'];
    $newOtp = $_SESSION['OTP'];
    if($newOtp == $pin){
        header("Location:resetPin.php");
        unset($_SESSION['OTP']);
    }else{
        echo "<div class='error_msg' id='toast'><i class='bx bx-x-circle msg-icon'></i>
        <p>Incorrect OTP. Please check once again!</p>
        </div>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EaseBank &mdash; Forgot Pin</title>
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


<body style="background: linear-gradient(to right bottom, #fff 50%, #6f42c1);">
    <div class="pinContainer">
        <div class="pinBox">
            <div class="sendMail">
                <h1>Forgot your password</h1>
                <p>Please enter the email address you'd like your password reset information sent to</p>
                <form action="" method="post" autocomplete="off">
                    <label for="">Enter email address</label>
                    <input type="email" name="email" required id="">
                    <button type="submit" name='reset'>Request reset OTP</button>
                    <a href="login.php" class="regLink">Back To Login</a>
                </form>
            </div>
            <div class="line"></div>
            <div class="verifyPin">
                <form action="" method="post" autocomplete="off">
                    <div class="pinForm">
                        <header><i class='bx bxs-check-shield'></i></header>
                        <h4>Enter OTP Pin</h4>
                        <div class="input_field">
                            <input type="number" class="pinInput" name="pin1" id="" length="1">
                            <input type="number" class="pinInput" name="pin2" id="" length="1" disabled>
                            <input type="number" class="pinInput" name="pin3" id="" length="1" disabled>
                            <input type="number" class="pinInput" name="pin4" id="" length="1" disabled>
                        </div>
                        <button class="pinInputBtn" name="otp">Verify Pin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
</body>

</html>