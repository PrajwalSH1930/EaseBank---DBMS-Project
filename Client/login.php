<?php
session_start();
include("connection.php");
$conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if(isset($_POST['admin'])){
    $admin_name = mysqli_real_escape_string($conn,$_POST['admin_name']);
    $admin_pin = mysqli_real_escape_string($conn,$_POST['admin_pin']);
    $res = mysqli_query($conn, "SELECT * FROM admin");
       while($row=mysqli_fetch_assoc($res)){
        $name = $row['admin_name'];
        $pin = $row['pin'];
       }
    if ($name == 'admin'&&$pin==$admin_pin) {
        header('Location:../Admin/adminInterface.php');
    } else
        echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i></i>
                        <p>Admin Not Found!, Check the Username and Pin.</p>
                        </div>";
    
}
if (isset($_POST['login'])) {
    $acc_num = mysqli_real_escape_string($conn,$_POST['acc_num']);
    $acc_pin = mysqli_real_escape_string($conn,$_POST['acc_pin']);
    
    $res = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_num='$acc_num' AND pwd='$acc_pin';") or die("Error!");
    $row = mysqli_fetch_assoc($res);
    
    if (is_array($row) && !empty($row)) {
        $_SESSION['valid'] = $row['acc_num'];
        $_SESSION['acc_id']=$row['acc_id'];
        $_SESSION['acc_name'] = $row['acc_name'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['acc_type']=$row['acc_type'];
        $_SESSION['balance']=$row['acc_amt'];
        $_SESSION['phone']=$row['phone'];
        $_SESSION['adhaar']=$row['adhaar'];
        $_SESSION['pan'] = $row['pan'];
        $_SESSION['email']=$row['email'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['created'] = $row['created_at'];
        $_SESSION['pwd'] = $row['pwd'];
    } else 
        echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i></i>
            <p>Invalid Account Number and Password combination!</p>
        </div>";
    
    if (isset($_SESSION['valid'])) {
        header("Location:interface.php");
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to &mdash; EaseBank</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="images/xing-logo-2447.png" type="image/x-icon">

    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <style>
    <?php include '../css/styles.css';
    include '../css/animation.css';

    include '../css/pages.css'?>.close-btn:hover {
        background: #6f42c1;
    }

    body {
        background: linear-gradient(to left top, #fff 0%, #6f42c1);
    }

    .log {
        font-size: 18px;
    }
    </style>
</head>

<body style="
background: linear-gradient(to left top, #fff 0%, #6f42c1);">
    <div id="loginForm">
        <div class="formContainer" id="container">
            <div class="form-container client">
                <a href="../index.php" style="position:absolute;top:1%;left:10%">
                    <ion-icon name="close" class="close-btn icon" id="closeBtn"></ion-icon>
                </a>
                <form action="" autocomplete="off" method="post">
                    <h1>Login As Client</h1>
                    <input type="text" placeholder="Account Number" required name="acc_num">
                    <input type="password" name="acc_pin" maxlength="4" required placeholder="Account Pin">
                    <a href="forgotPin.php" class="regLink">Forgot Pin?</a>
                    <button name="login">Login</button>
                    <p style="font-size:16px;margin-top:32px;">New User? <a href="register.php" style="font-size:16px;"
                            class="regLink">Register</a></p>
                </form>
            </div>
            <div class="form-container admin">
                <form action="" autocomplete="off" method="post">
                    <h1>Login As Admin</h1>
                    <input type="text" placeholder="Admin Username" required name="admin_name">
                    <input type="password" name="admin_pin" maxlength="4" required placeholder="Admin Pin">
                    <!-- <a href="">Forgot Pin?</a> -->
                    <button name="admin" style="margin-top:24px;">Login</button>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggleLogin">
                    <div class="toggle-panel toggle-left">
                        <h1>Manage your Money from Anywhere</h1>
                        <p>Login as a Client</p>
                        <button class="hiddenBtn" id="client">Client</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Welcome Back!</h1>
                        <p>Let's get started with our account!</p>
                        <button class="hiddenBtn" id="admin">Admin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    let toast = document.getElementById("toast");
    setTimeout((e) => {
        e.preventDefault();
        toast.remove();
    }, 8000);
    const clientBtn = document.getElementById("client"),
        container = document.getElementById("container"),
        adminBtn = document.getElementById("admin");

    adminBtn.addEventListener("click", () => {
        container.classList.add('active');
    })
    clientBtn.addEventListener("click", () => {
        container.classList.remove('active');
    })
    // const showPin = document.querySelector(".eyeOn"),
    //     hidePin = document.querySelector(".eyeOff");

    // function showPwd() {
    //     var show = document.getElementById("show");
    //     if (show.type === "password") {
    //         show.type = "text";
    //     } else {
    //         show.type = "password";
    //     }
    // }

    // showPin.addEventListener("click", function(e) {
    //     e.preventDefault();
    //     showPwd();
    //     showPin.style.display = "none";
    //     hidePin.style.display = "block";
    // });

    // hidePin.addEventListener("click", function(e) {
    //     e.preventDefault();
    //     showPwd();
    //     showPin.style.display = "block";
    //     hidePin.style.display = "none";

    // });
    </script>
</body>

</html>