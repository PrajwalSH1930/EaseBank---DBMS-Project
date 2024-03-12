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
<?php include '../css/interface.css'?><?php include '../css/styles.css'?><?php include '../css/pages.css'?>
</style>

<div class="profile_box">
    <h3 class="welcome">Welcome, Admin</h3>
    <!-- <p class="logout_timer">
        You will be logged out in <span class="timer">5:00</span>
    </p> -->
    <div class="profile">
        <i class="bx bxs-bell"></i>
        <img src="../profiles/profile.jpg" alt="" class="profile_img" />
        <p class="profile_name">Administrator</p>
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
            <a href="adminInterface.php" class="item" name="dashboard"><i
                    class="bx bxs-home"></i><span>Dashboard</span></a>
        </li>
        <div class="dropdown_content" style="margin-bottom:-2px;">
            <header class="menu_item dropdown_header">
                <i class='bx bxs-credit-card-alt'></i><span
                    style="margin-left:-64px;font-size:15px;font-weight:500;color:#555;">Clients</span><i
                    class='bx bx-chevron-down down'></i>
            </header>
            <div class="dropdown_desc">
                <ul>
                    <li class="menu_item"><a href="addClient.php" class="item"><i class='bx bxs-user-plus'></i>Add
                            Clients</a>
                    </li>
                    <li class="menu_item"><a href="manageClient.php" class="item"><i
                                class='bx bxs-user-detail'></i>Manage
                            Clients</a></li>
                </ul>
            </div>
        </div>
        <li class="menu_item">
            <a href="adminTransactions.php" class="item"><i
                    class="bx bxs-bar-chart-alt-2"></i><span>Transactions</span></a>
        </li>
        <li class="menu_item">
            <a href="loanApplicants.php" class="item"><i class='bx bxs-bank'></i><span>Loan Applicants</span></a>
        </li>
        <li class="menu_item">
            <a href="deletedAccs.php" class="item"><i class='bx bxs-trash'></i><span>Deleted Accounts</span></a>
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
        <a href="../client/logout.php" class="confirm-btn">Confirm</a>
        <button class=" cancel-btn btn-ok">Cancel</button>
    </div>
</div>
<div class="overlay-main hidden">
    <img src="../images/undraw_adventure_re_ncqp.svg" alt="" class="overlay-img left">
    <img src="../images/undraw_ether_re_y7ft.svg" alt="" class="overlay-img right">
</div>
<script>
<?php include '../js/logOut.js';?>
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