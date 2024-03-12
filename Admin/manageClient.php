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
    <title>EaseBank &mdash; Manage Clients</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">

</head>

<body>
    <?php 
    
        if(isset($_POST['deleteAcc'])){
        $acc_id = $_POST['deleteAcc'];
        mysqli_query($conn, "DELETE FROM accounts WHERE acc_id = $acc_id");
        echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                        <p>Client Successfully Removed.</p>
                        </div>";
        }
    ?>
    <div class="container">
        <?php include 'adminDashboard.php' ?>
        <div class="transaction_history">
            <h2 class="head">Manage Clients</h2>
            <div class="trans_table">
                <div class="head_box">
                    <p>Account holders in our bank.</p>
                    <div class="searchBox">
                        <i class='bx bx-search'></i>
                        <form action="" method="POST" autocomplete="off">
                            <input type="search" placeholder="Search" name="search" id="search">
                        </form>
                    </div>
                </div>

                <div class="mainTable">
                    <table>
                        <tr class="tableHead">
                            <th>#</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Account Type</th>
                            <th>Phone Number</th>
                            <th>Account Balance</th>
                            <th>UPI ID</th>
                            <th>Account Created At</th>
                            <th>Remove Client</th>
                        </tr>
                        <tbody id="post_list">
                            <tr class="trans_list-item">
                                <?php
                        $i = 1;
                        $res = mysqli_query($conn, "SELECT * FROM accounts ORDER BY acc_id DESC");
                        while($row = mysqli_fetch_assoc($res)){
                            // $tr_amt = number_format((float) $row['tr_amt'], 2, '.', '');
                                    $client_id = $row['acc_id'];
                                    $acc_type = $row['acc_type'];
                                    
        $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Deposit' ";
        $stmt = $conn->prepare($result);
        $stmt->bind_param('i', $client_id);
        $stmt->execute();
        $stmt->bind_result($iB_deposits);
        $stmt->fetch();
        $stmt->close();
        //return total number of iBank Withdrawals
        // $client_id = $_SESSION['acc_id'];
        $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Withdraw' ";
        $stmt = $conn->prepare($result);
        $stmt->bind_param('i', $client_id);
        $stmt->execute();
        $stmt->bind_result($iB_withdrawal);
        $stmt->fetch();
        $stmt->close();
        //return total number of iBank Transfers
        // $client_id = $_SESSION['acc_id'];
        $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Transfer' ";
        $stmt = $conn->prepare($result);
        $stmt->bind_param('i', $client_id);
        $stmt->execute();
        $stmt->bind_result($iB_Transfers);
        $stmt->fetch();
        $stmt->close();

        // $client_id = $_SESSION['acc_id'];
        $result = "SELECT SUM(tr_amt) FROM transactions WHERE  acc_id = ? AND tr_type = 'Recieved' ";
        $stmt = $conn->prepare($result);
        $stmt->bind_param('i', $client_id);
        $stmt->execute();
        $stmt->bind_result($iB_receives);
        $stmt->fetch();
        $stmt->close();
        // $incomeIndication = '';
        $TotalBalInAccount = ($iB_deposits) - (($iB_withdrawal) + ($iB_Transfers)) + ($iB_receives);
        
        switch($acc_type){
            case 'Savings':$incomeIndication=round(($TotalBalInAccount)*.027,2);break;
            case 'Deposit':$incomeIndication=round(($TotalBalInAccount)*.03,2);break;
            case 'Current':$incomeIndication=0;break;
            default:
                $incomeIndication = 0;
        }
                            $tr_amt = number_format((float) $TotalBalInAccount+$incomeIndication, 2, '.', '');
                        ?>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['acc_name'] ?></td>
                                <td><?php echo $row['acc_num'] ?></td>
                                <td><?php echo $row['acc_type'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td style="padding:0 20px;font-weight:600;">₹<?php echo $tr_amt?></td>
                                <td><?php echo $row['upi'] ?></td>
                                <td><?php echo $row['created_at'] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <button class="deleteBtn" name="deleteAcc" value="<?=$row['acc_id']?>">Remove
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
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
</body>

</html>