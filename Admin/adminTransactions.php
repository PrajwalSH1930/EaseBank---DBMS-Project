<?php
    session_start();
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EaseBank &mdash; Transactions</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <?php 
            
            if(isset($_POST['rollback'])){
                $OTP = rand(1000, 9999);
                $tr_code = $_POST['rollback'];
                // $_SESSION['OTP'] = $OTP;
                // $sql=mysqli_query($conn,"DELETE FROM transactions WHERE tr_code = '$tr_code'");
            //     while($row=mysqli_fetch_assoc($sql)){
            //         $name = $row['acc_name'];
            //         $email=$row['email'];
            //     }
            //     $subject = "Rollback Your Transaction";

            //     $message = "<html>
            
            // <head>
            //     <style>
            //     .mailbox {
            //         background-color: #f5f5f5;
            //         width: 250px;
            //         margin: 18px auto;
            //         padding: 0 16px 24px;
            //         border-top: 3px solid #6f42c1;
            //         border-radius: 4px;
            //         box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 2px rgba(0, 0, 0, 0.2);
            //     }
            //     .mailbox h2 {
            //         text-align: center;
            //         font-weight: 500;
            //     }
            //     .text {
            //         text-align: center;
            //         margin-bottom: 24px;
            //     }
            //     .details {
            //         margin: 12px auto;
            //         text-align: center;
            //         width: 240px;
            //         font-size: 14px;
            //     }
            //     img {
            //         width: 48px;
            //         height: 48px;
            //     }
            //     .copy {
            //         text-align: center;
            //         margin: 12px auto;
            //         width: 240px;
            //         font-size: 14px;
            //     }
            //     h1{
            //         margin-top:24px;
            //         font-weight: 500;
            //         color:#f5f5f5;
            //         text-align: center;
            //     }
            //     span{
            //         color:#85bb65;
            //     }
            //     </style>
            //     </head>
            //     <body>
            //     <p>Hi ,Prajwal Hiremath</p>
            //         <p>Greetings from the EaseBank!</p>
            //         <p>We got a request to rollback transaction for
            //         EaseBank account.</p>
            //         <div class='mailbox'>
            //             <h2>Your OTP is, {$OTP}</h2>
            //         </div>
            //         <p class='text'>
            //         If you ignore this message, your rollback  transaction will not be processed. If you didn't request a password reset, let us know.
            //     </p>
            //     <p class='details'>
            //     This email was sent to psh23g@gmail.com because you recently requested for rollback transaction for
            //     EaseBank Account.
            //     </p>
            //     </body>
            //     </html>";
            //     $email = "psh23g@gmail.com";
            //     $headers = "From: EaseBank <easebank.princeinc@gmail.com>\r\n";
            //     $headers .= "MIME-Version: 1.0\r\n";
            //     $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            //     echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
            //     <p>OTP has successfully sent to $email. Check your provided email.</p>
            //     </div>";
        
            //     mail($email, $subject, $message, $headers);
                mysqli_query($conn, "DELETE FROM transactions WHERE tr_code=$tr_code");
                echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                                <p>Transaction successfully rolled back.</p>
                                </div>";
            }
        ?>
        <?php include 'adminDashboard.php';?>
        <div class="transaction_history">
            <h2 class="head">Transaction History</h2>
            <div class="trans_table">
                <div class="head_box">
                    <p>Recent Transactions made by this account </p>
                    <div class="searchBox">
                        <i class='bx bx-search'></i>
                        <form action="" method="POST" autocomplete="off">
                            <input type="search" class="form-control form-control-sm" placeholder="Search..."
                                aria-controls="export" id="search">
                        </form>
                    </div>
                </div>
                <div class="mainTable">
                    <table id="">
                        <tr class="tableHead">
                            <th>#</th>
                            <th>Transaction Code</th>
                            <th>Account Number</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Acc Owner</th>
                            <th>Timestamp</th>
                            <th>Rollback</th>
                        </tr>
                        <tbody id="table-data">
                            <tr class="trans_list-item">
                                <?php
                            $i = 1;
                            $res = mysqli_query($conn, "SELECT * FROM transactions ORDER BY tr_id DESC");
                            while($row = mysqli_fetch_assoc($res)){
                                $tr_amt = number_format((float) $row['tr_amt'], 2, '.', '');
                                $date=date('M d, y',strtotime($row['created_at']));
                                $time=date('h:i A',strtotime($row['create_time']));
                        ?>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['tr_code'] ?></td>
                                <td><?php echo $row['acc_num'] ?></td>
                                <?php if ($row['tr_type'] == "Deposit") {
                        ?>
                                <td width="150px"><span
                                        class="deposit"><?php echo $row['tr_type'] ?>&nbsp;&nbsp;&uparrow;</span></td>
                                <?php }else if($row['tr_type'] == "Withdraw"){ ?>
                                <td width="150px" class="withdraw"><?php echo $row['tr_type'] ?>&nbsp;&nbsp;&downarrow;
                                </td>
                                <?php 
                        }else if($row['tr_type'] == "Transfer"){ ?>
                                <td width="150px" class="Transfer"><?php echo $row['tr_type'] ?>&nbsp;&nbsp;&gt;&gt;
                                </td>
                                <?php }else{?>
                                <td width="150px" class="receive"><?php echo $row['tr_type'] ?>&nbsp;&nbsp;&lt;&lt;</td>
                                <?php } ?>
                                <td>₹ <?php echo $tr_amt ?></td>
                                <td><?php echo $row['acc_name'] ?></td>
                                <td><?php echo $time.', '. $date ?></td>
                                <td>
                                    <form action="" method="post" onclick="">
                                        <button class="deleteBtn" name="rollback" id="rollBack"
                                            value="<?=$row['tr_code']?>">Rollback
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i += 1; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pinForm">
            <header><i class='bx bxs-check-shield'></i></header>
            <h4>Enter Account Pin</h4>
            <div class="input_field">
                <input type="number" class="pinInput" name="pin1" id="" length="1">
                <input type="number" class="pinInput" name="pin2" id="" length="1" disabled>
                <input type="number" class="pinInput" name="pin3" id="" length="1" disabled>
                <input type="number" class="pinInput" name="pin4" id="" length="1" disabled>
            </div>
            <button class="pinInputBtn" name="withdraw">Verify Pin</button>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    $(document).ready(function() {
        $('#search').on("keyup", function() {
            var search_term = $(this).val();
            $.ajax({
                url: '../search.php',
                type: "POST",
                data: {
                    search: search_term
                },
                success: function(data) {
                    $('#table-data').html(data);
                }
            })
        })
    })
    </script>
</body>

</html>