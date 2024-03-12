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
    <title>EaseBank &mdash; Notifications</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <style>
    <?php include '../css/pages.css'?>
    </style>
</head>

<body>
    <div class="container">
        <?php include 'dashboard.php'?>
        <div class="notifications">
            <!-- <h2 class="head">Notifications</h2> -->
            <div class="notBox">
                <div class="chatName">
                    <img src="../images/xing-logo-2447.png" alt="" class="dp">
                    <h2 class="dpLogo">Ease<span>Bank</span></h2>
                </div>
                <div class="notificationBox">
                    <p class="msgNote"><i class='bx bxs-lock-alt'></i>&nbsp;Messages are end-to-end encrypted. No one
                        outside
                        of this chat can read them.</p>
                    <?php
                    $acc_id = $_SESSION['acc_id'];
                    $sql = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id=$acc_id");
                    while($res=mysqli_fetch_assoc($sql)){
                        $acc_id = $res['acc_id'];
                    }
                    $res = mysqli_query($conn, "SELECT * FROM notifications WHERE acc_id=$acc_id ORDER BY created_at ASC");
                    while ($row = mysqli_fetch_assoc($res)) {                      
                        $timeStamp = $row['created_at'];                        
                        $dateTime = explode(" ", $timeStamp);
                        $date = $dateTime[0];
                        $time=date('h:i A',strtotime($dateTime[1]));
                ?>
                    <p class="dateTime"><?php echo $date.' • '.$time?></p>
                    <div class="message">
                        <img src="../images/xing-logo-2447.png" alt="" class="msgImg">
                        <div class="msg">
                            <p class="messageBody"><?php echo $row['not_desc']?>
                            </p>
                            <p class="msgTime"><?php echo $time ?></p>
                        </div>
                        <i class='bx bx-dots-vertical-rounded' id="options"></i>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
</body>

</html>