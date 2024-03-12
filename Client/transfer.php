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
    <title>EaseBank &mdash; Transfers</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
    <?php include '../css/pages.css'?>
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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
            }
        ?>
        <div class="transfer_form">
            <?php 
            $client_id = $_SESSION['acc_id'];
            $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Deposit' ";
            $stmt = $conn->prepare($result);
            $stmt->bind_param('i', $client_id);
            $stmt->execute();
            $stmt->bind_result($iB_deposits);
            $stmt->fetch();
            $stmt->close();
            //return total number of iBank Withdrawals
            $client_id = $_SESSION['acc_id'];
            $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Withdraw' ";
            $stmt = $conn->prepare($result);
            $stmt->bind_param('i', $client_id);
            $stmt->execute();
            $stmt->bind_result($iB_withdrawal);
            $stmt->fetch();
            $stmt->close();
            //return total number of iBank Transfers
            $client_id = $_SESSION['acc_id'];
            $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Transfer' ";
            $stmt = $conn->prepare($result);
            $stmt->bind_param('i', $client_id);
            $stmt->execute();
            $stmt->bind_result($iB_Transfers);
            $stmt->fetch();
            $stmt->close();

            $client_id = $_SESSION['acc_id'];
            $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Recieved' ";
            $stmt = $conn->prepare($result);
            $stmt->bind_param('i', $client_id);
            $stmt->execute();
            $stmt->bind_result($iB_receives);
            $stmt->fetch();
            $stmt->close();
            
            $TotalBalInAccount = ($iB_deposits)  - (($iB_withdrawal) + ($iB_Transfers)) + ($iB_receives);

            if(isset($_POST['transfer'])){
                $tr_code=$_POST['tr_code'];
                $tr_amt = number_format((float)$_POST['amount'], 2, '.', '');
                $receiver_name = $_POST['receiver_name'];
                $receiving_acc_holder = $_POST['receiving_acc_holder'];
                $result = mysqli_query($conn, "SELECT acc_id FROM accounts WHERE acc_num=$receiver_name");
                $pin = "";
                $pin = $_POST['pin1'] . $_POST['pin2'] . $_POST['pin3'] . $_POST['pin4'];
                while($row=mysqli_fetch_assoc($result)){
                    $receiver_acc_id = $row['acc_id'];
                }
                if($pin==$pwd){
                    if($TotalBalInAccount>$tr_amt){
                        $tr_type = 'Transfer';
                        $date=date('d-m-Y H:i:s');
                        $message = "A/c $acc_num Debited for Rs.$tr_amt on $date by Transfer ref no $tr_code -EaseBank.";
                        $receiver_msg = "A/c $receiver_name Credited for Rs.$tr_amt on $date by Transfer ref no $tr_code -EaseBank.";
                        mysqli_query($conn, "INSERT INTO transactions(tr_code,acc_id,acc_name,acc_num,acc_type,tr_type,tr_amt,receivingAcc_no,receivingAcc_name) VALUES ('{$tr_code}','{$acc_id}','{$acc_name}','{$acc_num}','{$acc_type}','{$tr_type}','{$tr_amt}','{$receiver_name}','{$receiving_acc_holder}')");
                        mysqli_query($conn, "INSERT INTO transactions(tr_code,acc_id,acc_name,acc_num,acc_type,tr_type,tr_amt,transferd_by) VALUES ('{$tr_code}','{$receiver_acc_id}','{$receiving_acc_holder}','{$receiver_name}','{$acc_type}','Recieved','{$tr_amt}','{$acc_name}')");
                        mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$message}')");
                        mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$receiver_acc_id}','{$receiver_msg}')");
                        echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                        <p>A/c $acc_num Debited for Rs.$tr_amt on $date by Transfer ref no $tr_code -EaseBank.</p>
                        </div>";
                    }else{
                        echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i></i>
                        <p>A/c $acc_num Transaction is cancelled due to Insufficient balance in the account.</p>
                        </div>";
                    }
                }
                else{
                    echo "<div class='error_msg' id='toast'><i class='bx bx-x-circle msg-icon'></i>
                    <p>Incorrect Pin.</p>
                    </div>";
                } 
            }
        ?>
            <h2 class="secondary_head">Transfer Money</h2>
            <form method="post" onclick="openPinModel()" autocomplete="off">
                <div class="grid-2-cols">
                    <div class="transfer_div">
                        <label for="">Client Name</label>
                        <input type="text" readonly value="<?php echo $acc_name?>" required class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Client PAN Number</label>
                        <input type="text" readonly value="<?php echo $pan?>" required class="readonly">
                    </div>

                </div>
                <div class="grid-2-cols">
                    <div class="transfer_div">
                        <label for="">Client Phone Number</label>
                        <input type="text" readonly value="<?php echo $phone?>" required class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Account Name</label>
                        <input type="text" readonly required value="<?php echo $acc_name?>" class="readonly">
                    </div>
                </div>
                <div class="grid-2-cols">

                    <div class="transfer_div">
                        <label for="">Account Number</label>
                        <input type="text" readonly required value="<?php echo $acc_num?>" class="readonly">
                    </div>
                    <div class="transfer_div">
                        <label for="">Account Type | Category</label>
                        <input type="text" readonly required value="<?php echo $acc_type?>" class="readonly">
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
                        <label for="">Amount Transferred(₹)</label>
                        <input type="text" name="amount" required pattern="{1-9}" />
                    </div>
                </div>
                <div class="grid-2-cols">
                    <div class="transfer_div">
                        <label for="">Receiving Account Number</label>
                        <select name="receiver_name" required class="form-control" id="acc_num"
                            onChange="getBankAcc(this.value);">
                            <option>Select Receiving Account</option>
                            <?php
                                $sql = "SELECT * FROM accounts WHERE acc_id!=$acc_id";
                                $res= mysqli_query($conn,$sql);
                                while ($row = mysqli_fetch_assoc($res)){
                                ?>
                            <option value="<?php echo $row['acc_num'] ?>"><?php echo $row['acc_num'] ?></option>
                            <?php } 
                                
                            ?>
                        </select>
                    </div>
                    <div class="transfer_div">
                        <label for="">Receiving Account Holder</label>
                        <input type="text" required name="receiving_acc_holder" id="accountHolder" value="">
                    </div>
                </div>
                <button type="submit" name="transferBtn" class="transfer_btn">Transfer
                    Funds</button>
                <div class="pinForm">
                    <header><i class='bx bxs-check-shield'></i></header>
                    <h4>Enter Account Pin</h4>
                    <div class="input_field">
                        <input type="number" class="pinInput" name="pin1" id="" length="1">
                        <input type="number" class="pinInput" name="pin2" id="" length="1" disabled>
                        <input type="number" class="pinInput" name="pin3" id="" length="1" disabled>
                        <input type="number" class="pinInput" name="pin4" id="" length="1" disabled>
                    </div>
                    <button class="pinInputBtn" name="transfer">Verify Pin</button>
                </div>
            </form>
        </div>
        <div class="paymentsToBe">
            <h2 class="secondary_head">Add Payment</h2>
            <div class="addPayment">
                <?php 
                if (isset($_POST['payBtn'])) {
    $payeeName = $_POST['payeeName'];
    $payAmount = $_POST['payAmount'];
    $note = $_POST['note'];
    $payRes = mysqli_query($conn, "INSERT INTO payments(acc_id,payment_to,pay_amt,notes) VALUES ('{$acc_id}','{$payeeName}','{$payAmount}','{$note}');") or die("Error");
    // header("Location:transfer.php");
    echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                        <p>Payment added!.</p>
                        </div>";
}
                ?>
                <form action="" class="payForm" method="post" autocomplete="off">
                    <div class="grid-2-cols">
                        <div class="payFormDiv">
                            <label for="">Name</label>
                            <input type="text" name="payeeName" id="" required>
                        </div>
                        <div class="payFormDiv">
                            <label for="">Amount</label>
                            <input type="text" name="payAmount" required>
                        </div>
                    </div>
                    <div class="noteBlock">
                        <input type="text" name="note" placeholder="Enter note">
                    </div>
                    <button name="payBtn" class="payBtn">Add Payment</button>
                </form>
            </div>
            <h2 class="secondary_head">Payments to be</h2>
            <?php 
                                if(isset($_POST['doneBtn'])){
    $id = $_POST['doneBtn'];
    mysqli_query($conn, "DELETE FROM payments WHERE pay_id=$id");
    // header("Location:transfer.php");
    echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                        <p>Payment done!.</p>
                        </div>";
}
                                ?>
            <div class="payeeList">
                <?php
                            $payRes = mysqli_query($conn,"SELECT * FROM payments WHERE acc_id=$acc_id");
                            while($row = mysqli_fetch_assoc($payRes)){
                        ?>
                <div class="payeeCard">
                    <div class="payeeDet">
                        <h3 class="payeeName"><?php echo $row['payment_to']?></h3>
                        <p class="payeeAmount">₹ <?php echo $row['pay_amt']?></p>
                    </div>

                    <p class="note">Note : <?php echo $row['notes']?></p>
                    <div class="buttons">
                        <form action="" method="post">
                            <button name="doneBtn" value="<?=$row['pay_id']?>">Done</button>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
    <script>
    function getBankAcc(val)

    {
        var acc_num = $('#acc_num').val();
        $.ajax({
            url: "update.php",
            method: "POST",
            data: {
                acc_num: acc_num,
            },
            success: function(data) {
                $('#accountHolder').val(data);
            }
        });
    }
    </script>
</body>

</html>