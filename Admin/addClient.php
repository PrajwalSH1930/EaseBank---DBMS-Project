<?php
    session_start();
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if(isset($_POST['addClient'])){
        $name=$_POST['name'];
        $fname=explode(" ",$name)[0];
        $pan=$_POST['pan'];
        $adhaar=$_POST['adhaar'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $dob=date('Y-m-d',strtotime($_POST['dob']));
        $acc_type = trim($_POST['acc_type']," ");
        $gender = $_POST['gender'];
        $acc_num =rand(1000000,1999999);
        $pin=$_POST['pin'];
        $confPin=$_POST['confPin']; 
        $tr_code =  rand(100000000000,199999999999);
        $amount = number_format((float) $_POST['amount'], 2, '.', '');
        $tr_type = 'Deposit';
        $upi = $phone."@okeasebank";
        $date=date('d-m-Y H:i:s');
        $verify_query = mysqli_query($conn, "SELECT email FROM accounts WHERE email='$email'");
        if(mysqli_num_rows($verify_query)!=0){
            echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i>
            <p>Error Occurred!, Try again later or The provided email has already been registered.</p>
            </div>";
        }else{
        // INSERTING INTO ACCOUNTS
            $sql = "INSERT INTO accounts(acc_name,acc_num,gender,acc_type,phone,adhaar,pan,email,dob,address,pwd,upi) VALUES
            ('{$name}','{$acc_num}','{$gender}','{$acc_type}','{$phone}','{$adhaar}','{$pan}','{$email}','{$dob}','{$address}','{$pin}','{$upi}');";
            $res=mysqli_query($conn,$sql);
            // FETCHING ID NUMBER FROM REGISTERED ACCOUNT
            $sql2 = "SELECT acc_id FROM accounts WHERE acc_num = {$acc_num};";
            $res2=mysqli_query($conn,$sql2);
            $acc_id=mysqli_fetch_column($res2);

            $welcome = "Hello, {$name}!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.";
            mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$welcome}')");
            // INSERTING INTO NOTIFICATIONS
            $nots= "A/c $acc_num Credited for $amount on $date by Deposit ref no $tr_code -EaseBank.";
            $sql3 = "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$nots}');";
            $res3=mysqli_query($conn,$sql3);
            //INSERTING INTO TRANSACTIONS
            $sql4 = "INSERT INTO transactions(tr_code,acc_id,acc_name,acc_num,acc_type,tr_type,tr_amt) VALUES('{$tr_code}','{$acc_id}','{$name}','{$acc_num}','{$acc_type}','{$tr_type}','{$amount}');";
            $res4=mysqli_query($conn,$sql4);

        $subject = "Let's get started with EaseBank";
        $message= "<html>
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
      <h2>Let's get started, {$fname}</h2>
      <p class='text'>
        Welcome to EaseBank. Your new account comes with access of all features
        and services.
      </p>
      <h2>Login Credentials</h2>
      Account Number : {$acc_num} <br />Password : {$pin}
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
        <p>Congratulations $fname, Your account has been successfully created🎉.For login credentials check your provided email $email.</p>
        </div>";
            }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EaseBank &mdash; Add Clients</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">

</head>

<body>
    <div class="container">
        <?php include 'adminDashboard.php' ?>
        <div class="deposit_form" style="background:#f8f8f8;">
            <h2 class="secondary_head">Add New Client</h2>
            <form method="post" autocomplete="off">
                <div class="grid-3-cols">
                    <div class="transfer_div">
                        <label for="">Client Name</label>
                        <input type="text" name="name" value="" required>
                    </div>
                    <div class="transfer_div">
                        <label for="">Client PAN Number</label>
                        <input type="text" name="pan" value="" required>
                    </div>
                    <div class="transfer_div">
                        <label for="">Client Adhaar Number</label>
                        <input type="text" name="adhaar" required>
                    </div>
                </div>
                <div class="grid-3-cols">
                    <div class="transfer_div">
                        <label for="">Client Address</label>
                        <input type="text" name="address" required>
                    </div>
                    <div class="transfer_div">
                        <label for="">Client Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="transfer_div">
                        <label for="">Client Phone Number</label>
                        <input type="text" name="phone" required>
                    </div>
                </div>
                <div class="grid-3-cols">
                    <div class="transfer_div">
                        <label for="">Date of Birth</label>
                        <input type="date" name="dob" required>
                    </div>
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
                        <label for="">Gender</label>
                        <select name="gender" id="" required />
                        <option value="">Select Account Type</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="N">No to Specify</option>
                        </select>
                    </div>
                </div>
                <div class="grid-3-cols">
                    <div class="transfer_div">

                        <label for="">Account Number</label>
                        <input type="text" name="acc_num" readonly class='readonly' value="XXXXXXXX" required>
                    </div>
                    <div class="transfer_div">
                        <label for="">Account PIN</label>
                        <input type="password" name="pin" maxlength="4" required>
                    </div>
                    <div class="transfer_div">
                        <label for="">Confirm PIN</label>
                        <input type="password" name="confPin" maxlength="4" required>
                    </div>
                </div>
                <div class="grid-2-cols">
                    <?php
                    ?>
                    <div class="transfer_div">
                        <label for="">Reference ID</label>
                        <input type="text" name="tr_code" readonly required value="XXXXXXXXXXXX" class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Amount To be Deposited(₹)</label>
                        <input type="text" name="amount" required pattern="{1-9}" id="amount" />
                    </div>
                </div>
                <button type="submit" name="addClient" class="transfer_btn">
                    Add Client</button>
            </form>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
</body>

</html>