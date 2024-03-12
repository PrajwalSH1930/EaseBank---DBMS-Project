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
    <title>EaseBank &mdash; Transactions</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <style>
    <?php include '../css/pages.css';
    include '../css/animation.css'?>
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <?php include 'dashboard.php'?>
        <div class="transaction_history">
            <h2 class="head">Transaction History</h2>
            <div class="trans_table">
                <div class="head_box">
                    <p>Recent Transactions made by this account </p>
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
                            <th>Transaction Code</th>
                            <th>Account Number</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Acc Owner</th>
                            <th>Timestamp</th>
                        </tr>
                        <tbody id="table-data">
                            <tr class="trans_list-item">
                                <?php
                                $i = 1;
                                $acc_id = $_SESSION['acc_id'];
                                $res = mysqli_query($conn, "SELECT * FROM transactions WHERE acc_id=$acc_id ORDER BY tr_id DESC");
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
                                <td><?php echo $time.', '.$date ?></td>

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
    <script>
    $(document).ready(function() {
        $('#search').on("keyup", function() {
            var search_term = $(this).val();
            $.ajax({
                url: 'search.php',
                type: "POST",
                data: {
                    search: search_term,
                    acc_id: <?=$acc_id?>,
                    acc_num: <?=$acc_num?>
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