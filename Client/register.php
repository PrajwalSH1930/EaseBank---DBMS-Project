<?php
include("connection.php");
$conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
if(isset($_POST['reg_submit'])){
        $name = $_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $dob=date('Y-m-d',strtotime($_POST['dob']));
        $address=$_POST['place'];
        $pan=$_POST['pan'];
        $adhaar=$_POST['aadhar'];
        $pwd=$_POST['pwd'];
        $acc_no = rand(1000000,1999999);
        $acc_type = trim($_POST['acc_type']," ");
        $tr_type = 'Deposit';
        $upi = $phone. "@okeasebank";
        $gender = $_POST['gender'];
        $length = 15;
        $amount = $_POST['amount'];
        $date=date('d-m-Y H:i:s');
        $_transcode =  rand(100000000000,199999999999);
        $verify_query = mysqli_query($conn, "SELECT email FROM accounts WHERE email='$email'");
        if(mysqli_num_rows($verify_query)!=0){
            echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i>
            <p>Error Occurred!, Try again later or The provided email has already been registered.</p>
            </div>";
        }else{
        // INSERTING INTO ACCOUNTS
            if($amount>=5000){
              $sql = "INSERT INTO accounts(acc_name,acc_num,gender,acc_type,phone,adhaar,pan,email,dob,address,pwd,upi) VALUES
            ('{$name}','{$acc_no}','{$gender}','{$acc_type}','{$phone}','{$adhaar}','{$pan}','{$email}','{$dob}','{$address}','{$pwd}','{$upi}');";
            $res=mysqli_query($conn,$sql);
            // FETCHING ID NUMBER FROM REGISTERED ACCOUNT
            $sql2 = "SELECT acc_id FROM accounts WHERE acc_num = {$acc_no};";
            $res2=mysqli_query($conn,$sql2);
            $acc_id=mysqli_fetch_column($res2);

            $welcome = "Hello, {$name}!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.";
            mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$welcome}')");
            // INSERTING INTO NOTIFICATIONS
            $nots= "A/c $acc_no Credited for Rs.5000.00 on $date by Deposit ref no $_transcode -EaseBank.";
            $sql3 = "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$nots}');";
            $res3=mysqli_query($conn,$sql3);
            //INSERTING INTO TRANSACTIONS
            $sql4 = "INSERT INTO transactions(tr_code,acc_id,acc_name,acc_num,acc_type,tr_type,tr_amt) VALUES('{$_transcode}','{$acc_id}','{$name}','{$acc_no}','{$acc_type}','{$tr_type}','{$amount}');";
            $res4=mysqli_query($conn,$sql4);

        $subject = "Let's get started with EaseBank";
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
    <p>Hi {$name},</p>
    <p>Greetings from the EaseBank!</p>
    <p><b>Congratulations your account has been verified successfully!</b></p>
    <div class='mailbox'>
      <h2>Let's get started, {$name}</h2>
      <p class='text'>
        Welcome to EaseBank. Your new account comes with access of all features
        and services.
      </p>
      <h2>Login Credentials</h2>
      Account Number : {$acc_no} <br />Password : {$pwd}
    </div>
    <p class='details'>
      This email was sent to {$email} because you recently signed into your
      EaseBank Account.
    </p>
    <h1>Ease<span>Bank</span></h1>
  </body>
</html>";
        $headers = "From: EaseBank <easebank.princeinc@gmail.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($email, $subject, $message, $headers);
        echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
        <p>Congratulations $name, Your account has been successfully created🎉.For login credentials check your provided email $email.</p>
        </div>";
            }
            else{
              echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i>
        <p>Please deposit a minimum of amount ₹5000.</p>
        </div>";
            }
            }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to &mdash; EaseBank</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/interface.css">
    <link rel="stylesheet" href="../css/queries.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script defer src="../js/script.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <style>
    h2 {
        font-weight: 500;
        font-size: 26px;
        position: relative;
    }

    h2::before {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        height: 3px;
        width: 58px;
        border-radius: 8px;
        background: linear-gradient(to right, #abcdef, #6f42c1)
    }

    .close-btn:hover {
        background: #6f42c1;
    }

    <?php include '../css/styles.css';
    include '../css/pages.css';
    include '../css/animation.css'?>
    </style>
</head>

<body
    style="display:flex;align-items:center;height:100vh;justify-content:center;background: linear-gradient(to left bottom,#6f42c1, #fff 50%, #6f42c1);">
    <div class="regForm">

        <form action="" method="post" autocomplete="off">
            <a href="../index.php">
                <ion-icon name="close" class="close-btn icon" id="closeBtn"></ion-icon>
            </a>
            <h2><span>Open</span> Bank Account in Just 5 Minutes!</h2>
            <div class="grid-2-cols">
                <div class="transfer_div">
                    <label for="Full Name">Full Name</label>
                    <input type="text" name="name" id="" required>
                </div>
                <div class="transfer_div">
                    <label for="Full Name">Phone Number</label>
                    <input type="tel" maxlength="10" name="phone" id="" required>
                </div>
            </div>
            <div class="grid-2-cols">
                <div class="transfer_div">
                    <label for="Full Name">Email</label>
                    <input type="email" name="email" id="" required>
                </div>
                <div class="transfer_div">
                    <label for="">Date of Birth</label>
                    <input type="date" name="dob" id="" required>
                </div>
            </div>
            <div class="grid-2-cols">

                <div class="transfer_div">
                    <label for="">Address</label>
                    <input type="text" name="place" id="" required>
                </div>
                <div class="transfer_div">
                    <label for="">Gender</label>
                    <select name="gender" id="" required>
                        <option value="">Select your Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="N">Not to be specified</option>
                    </select>
                </div>
            </div>
            <div class="grid-3-cols">
                <div class="transfer_div">
                    <label for="">Adhaar Number</label>
                    <input type="text" name="aadhar" id="" maxlength="12" required>
                </div>
                <div class="transfer_div">
                    <label for="">PAN Number</label>
                    <input type="text" name="pan" id="" maxlength="10" required>
                </div>
                <div class="transfer_div">
                    <label for="">Amount to be deposited</label>
                    <input type="text" name="amount" id="" maxlength="" placeholder="(Minimum of ₹5000)" required>
                </div>
            </div>
            <div class="grid-3-cols">
                <div class="transfer_div">
                    <label for="">Account Type</label>
                    <select name="acc_type" id="" required />
                    <option value="">Select Account Type</option>
                    <?php
                            $sql = "SELECT * FROM acc_types";
                            $res= mysqli_query($conn,$sql);
                            while ($row = mysqli_fetch_assoc($res)){
                            ?>
                    <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                    <?php } ?>
                    </select>
                </div>

                <div class="transfer_div">
                    <label for="">Password</label>
                    <input type="password" maxlength="4" name="pwd" id="" required>
                </div>
                <div class="transfer_div">
                    <label for="">Confirm Password</label>
                    <input type="password" maxlength="4" name="con_pwd" id="" required>
                </div>
            </div>
            <div class="regDiv">
                <button type="submit" name="reg_submit" class="register">Open Your Account</button>
                <p>Already A User? <a href="login.php" class="regLink">Login</a></p>
            </div>
        </form>
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
</body>

</html>