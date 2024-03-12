<?php
    session_start();
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if(!isset($_SESSION['valid'])){
    header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EaseBank &mdash; Deposits</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
    <?php include '../css/pages.css';
    include '../css/animation.css'?>
    </style>
</head>

<body>

    <div class="container">
        <?php include 'dashboard.php'?>
        <?php
        $acc_id = $_SESSION['acc_id'];
        $sql = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id=$acc_id");
            while($res=mysqli_fetch_assoc($sql)){
                $acc_id = $res['acc_id'];
                $acc_name = $res['acc_name'];
                $acc_num=$res['acc_num'];
                $acc_type=$res['acc_type'];
                $phone=$res['phone'];
                $pan=$res['pan'];
                $pwd=$res['pwd'];
                $upi=$res['upi'];
                $adhaar=$res['adhaar'];
            }
            $pin = "";
            if (isset($_POST['depositBtn'])) {
                $tr_code = $_POST['tr_code'];
                $tr_amt = number_format((float) $_POST['amount'], 2, '.', '');
                if($_POST['amount']<=100000){
                    $tr_type = 'Deposit';
                    $date = date('d-m-Y H:i:s');
                    $pin = $_POST['pin1'] . $_POST['pin2'] . $_POST['pin3'] . $_POST['pin4'];
                    if($pin==$pwd){
                        $message = "A/c $acc_num Credited for Rs.$tr_amt on $date by Deposit ref no $tr_code -EaseBank.";
                        mysqli_query($conn, "INSERT INTO transactions(tr_code,acc_id,acc_name,acc_num,acc_type,tr_type,tr_amt) VALUES ('{$tr_code}','{$acc_id}','{$acc_name}','{$acc_num}','{$acc_type}','{$tr_type}','{$tr_amt}')");
                        mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$message}')");
                        echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                        <p>A/c $acc_num Credited for Rs.$tr_amt on $date by Deposit ref no $tr_code -EaseBank.</p>
                        </div>";
                    }else{
                        echo "<div class='error_msg' id='toast'><i class='bx bx-x-circle msg-icon'></i>
                        <p>Incorrect Pin.</p>
                        </div>";
                    }   
                }else{
                    echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i>
                        <p>Please enter the amount less than the limit!</p>
                        </div>";
                }
            }
        ?>
        <div class="deposit_form">
            <h2 class="secondary_head">Deposit Money</h2>
            <form method="post" onclick="openPinModel()" autocomplete="off">
                <div class="grid-3-cols">
                    <div class="transfer_div">
                        <label for="">Client Name</label>
                        <input type="text" name="name" readonly value="<?php echo $acc_name?>" required
                            class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Client PAN Number</label>
                        <input type="text" name="pan" readonly value="<?php echo $pan?>" required class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Client Adhaar Number</label>
                        <input type="text" readonly value="<?php echo $adhaar?>" required class="readonly">
                    </div>

                </div>
                <div class="grid-3-cols">
                    <div class="transfer_div">
                        <label for="">Account Name</label>
                        <input type="text" readonly required value="<?php echo $acc_name?>" class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">UPI ID</label>
                        <input type="text" readonly required value="<?php echo $upi?>" class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Client Phone Number</label>
                        <input type="text" readonly value="<?php echo $phone?>" required class="readonly">
                    </div>
                </div>
                <div class="grid-2-cols">
                    <div class="transfer_div">
                        <label for="">Account Number</label>
                        <input type="text" name="acc_num" readonly required value="<?php echo $acc_num?>"
                            class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Account Type | Category</label>
                        <input type="text" name="acc_type" readonly required value="<?php echo $acc_type?>"
                            class="readonly">
                    </div>
                </div>
                <div class="grid-2-cols">
                    <?php
                        $_transcode =  rand(100000000000,199999999999);
                    ?>
                    <div class="transfer_div">
                        <label for="">Reference ID</label>
                        <input type="text" name="tr_code" readonly required value="<?php echo $_transcode?>"
                            class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Amount To be Deposited(₹)</label>
                        <input type="text" name="amount" required pattern="{1-9}" id="amount"
                            placeholder="Maximum limit 100000" />
                    </div>
                </div>
                <button type="submit" name="deposit" class="transfer_btn">
                    Deposit Funds</button>
                <div class="pinForm">
                    <header><i class='bx bxs-check-shield'></i></header>
                    <h4>Enter Account Pin</h4>
                    <div class="input_field">
                        <input type="number" class="pinInput" name="pin1" id="" length="1">
                        <input type="number" class="pinInput" name="pin2" id="" length="1" disabled>
                        <input type="number" class="pinInput" name="pin3" id="" length="1" disabled>
                        <input type="number" class="pinInput" name="pin4" id="" length="1" disabled>
                    </div>
                    <button class="pinInputBtn" name="depositBtn">Verify Pin</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    <?php include '../js/pages.js'?>
    </script>
</body>

</html>