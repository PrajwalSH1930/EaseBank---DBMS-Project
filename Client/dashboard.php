<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap"
    rel="stylesheet">
<link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/jgthms/minireset.css@master/minireset.min.css">
<script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<style>
<?php include '../css/interface.css'?><?php include '../css/styles.css'?><?php include '../css/pages.css';
?>
</style>
<?php
        $acc_id = $_SESSION['acc_id'];
        $sql = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id=$acc_id");
            while($res=mysqli_fetch_assoc($sql)){
                $acc_id = $res['acc_id'];
                $acc_name = $res['acc_name'];
                $name = explode(" ", $acc_name);
                $fname = $name[0];
                $acc_num=$res['acc_num'];
                $pwd=$res['pwd'];
                $profile = $res['profile_pic'];
                $gender = $res['gender'];
            }
        ?>
<div class="profile_box">
    <h3 class="welcome">Welcome, <?php echo $fname ?></h3>
    <!-- <p class="logout_timer">
        You will be logged out in <span class="timer">5:00</span>
    </p> -->
    <div class="profile">
        <i class="bx bxs-bell"></i>
        <img src="../profiles/<?php 
            if(empty($profile)&& $gender=="M"){
            echo "male.webp";
            }else if(empty($profile)&& $gender=="F"){
            echo "female.webp";
            }else if(empty($profile)&& $gender=="N"){
            echo "profile.jpg";
            }else{
            echo $profile;
            }
        ?>" alt="" class="profile_img" />
        <p class="profile_name"><?php echo $acc_name ?></p>
        <i class="bx bx-chevron-down"></i>
    </div>
</div>

<div class="menu_bar">
    <div class="app_logo_field">
        <i class='bx bxl-xing logoIcon'></i>
        <h2>Ease<span>Bank</span></h2>
    </div>
    <ul class="menu_list">
        <li class="menu_item">
            <a href="interface.php" class="item" name="dashboard"><i class="bx bxs-home"></i><span>Dashboard</span></a>
        </li>
        <div class="dropdown_content">
            <header class="menu_item dropdown_header">
                <i class='bx bxs-credit-card-alt'></i><span>Finances</span><i style="margin-left:50px;"
                    class='bx bx-chevron-down down'></i>
            </header>
            <div class="dropdown_desc">
                <ul>
                    <li class="menu_item"><a href="deposit.php" class="item"><i class='bx bxs-wallet'></i>Deposit</a>
                    </li>
                    <li class="menu_item"><a href="withdraw.php" class="item"><i
                                class='bx bx-money-withdraw'></i>Withdraw</a></li>
                    <li class="menu_item"><a href="transfer.php" class="item"><i
                                class='bx bx-transfer-alt'></i>Transfer</a></li>
                    <li class="menu_item"><a href="loan.php" class="item"><i class='bx bxs-bank'></i>Loan</a></li>
                </ul>
            </div>
        </div>
        <li class="menu_item">
            <a href="transactions.php" class="item"><i class="bx bxs-bar-chart-alt-2"></i><span>Transactions</span></a>
        </li>
        <li class="menu_item">
            <a href="card.php" class="item"><i class="bx bxs-credit-card"></i><span>Cards and Payments</span></a>
        </li>
        <li class="menu_item">
            <a href="notification.php" class="item"><i
                    class='bx bxs-message-detail'></i></i><span>Notifications</span></a>
        </li>
        <li class="menu_item">
            <a href="details.php" class="item"><i class='bx bxs-user-detail'></i></i><span>Account Details</span></a>
        </li>
        <li class="menu_item">
            <a href="settings.php" class="item"><i class="bx bxs-cog"></i><span>Settings</span></a>
        </li>
        <div class="menu_down">
            <li class="menu_item log_out--acc">
                <i class="bx bx-log-out"></i><span>Log out</span>
            </li>
        </div>
    </ul>
</div>
<div class="log-out--model hidden">
    <h2 id="logout_head">Logout ?</h2>
    <ion-icon name="close" class="close-btn icon btn-ok" id="logout_cross"></ion-icon>
    <p id="logout_text">You will be redirected to Login page.</p>
    <div class="btn-container" id="logout-btns">
        <!-- <button class="confirm-btn" name="logout">Confirm</button> -->
        <a href="logout.php" class="confirm-btn">Confirm</a>
        <button class="cancel-btn btn-ok">Cancel</button>
    </div>
</div>
<div class="overlay-main hidden">
    <img src="../images/undraw_adventure_re_ncqp.svg" alt="" class="overlay-img left">
    <img src="../images/undraw_ether_re_y7ft.svg" alt="" class="overlay-img right">
</div>
<!-- <script src="logOut.js"></script> -->

<script>
<?php include '../js/logOut.js'?>
</script>

<script>
const dashBlocks = document.querySelectorAll(".menu_item");
dashBlocks.forEach((dash, index) => {
    dash.addEventListener("click", (e) => {
        // e.preventDefault();
        dashBlocks.forEach((dash) => {
            dash.classList.remove("active");
        });
        dash.classList.add("active");
    });
});
</script>