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
    <title>EaseBank &mdash; Deleted Accounts</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <style>
    <?php include '../css/interface.css'?><?php include '../css/styles.css';
    include '../css/animation.css'?><?php include '../css/pages.css'?>
    </style>
    <style>

    </style>
</head>

<body>
    <div class="container">
        <?php include 'adminDashboard.php'?>
        <div class="deletedAccs">
            <h2 class="head">Deleted / Deactivated Accounts</h2>
            <div class="trans_table">
                <div class="head_box">
                    <p>Recent Deleted Account with their feedback. </p>
                    <div class="searchBox">
                        <i class='bx bx-search'></i>
                        <form action="" method="POST" autocomplete="off">
                            <input type="search" class="form-control form-control-sm" placeholder="Search..."
                                aria-controls="export">
                        </form>
                    </div>
                </div>
                <div class="mainTable">
                    <table id="example1">
                        <tr class="tableHead">
                            <th>#</th>
                            <th>Account Number</th>
                            <th>Reason</th>
                            <th>Deleted At</th>
                        </tr>
                        <tbody id="post_list">
                            <tr class="trans_list-item">
                                <?php
                        $i = 1;
                        $res = mysqli_query($conn, "SELECT * FROM deleted_accs ORDER BY id DESC");
                        while($row = mysqli_fetch_assoc($res)){
                            $date=date('M d, y',strtotime($row['deleted_at']));
                            $time=date('h:i A',strtotime($row['deleted_at']));
                        ?>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['acc_num'] ?></td>
                                <td><?php echo $row['reason']?></td>
                                <td><?php echo $time.', '. $date ?></td>
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