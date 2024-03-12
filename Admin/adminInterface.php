<?php
    session_start();
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EaseBank &mdash; Dashboard</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <script src="../plugins/canvasjs.min.js"></script>
</head>

<body>
    <div class="container">
        <?php include 'adminDashboard.php';?>

        <style>
        <?php include '../css/interface.css'?><?php include '../css/styles.css'?><?php include '../css/queries.css';

        include '../css/animation.css'?>hr {
            width: 1px;
            border: 1px solid #777;
            border-radius: 50%;
        }
        </style>
        <?php
            $mov = "SELECT tr_amt,tr_type,created_at,create_time FROM transactions ORDER BY tr_id DESC";
            $resMov = mysqli_query($conn, $mov);
            ?>
        <div class="exp_chart" style="grid-row:2/span 3">
            <div class="chart_name">
                <h3>Statistics</h3>
                <p class="date">01/12/2023</p>
            </div>
            <div id="pieChart" style="height:280px;max-width:1000px;margin:-24px auto 34px;">
            </div>
            <div id="accChart" style="height:280px;max-width:1000px;margin:20px auto;"></div>
        </div>

        <div class="movements_details" style="grid-row:2 / 5;">
            <h2>Total Transactions</h2>
            <ul class="option_list">
                <li class="options">All</li>
                <li class="options inc_sort">Type</li>
                <li class="options exp_sort">Amount</li>
            </ul>
            <?php
                while($row = mysqli_fetch_assoc($resMov)){
                $tr_amt = number_format((float) $row['tr_amt'], 2, '.', '');
                $date=date('M d, y',strtotime($row['created_at']));
                $time=date('h:i A',strtotime($row['create_time']));
            ?>

            <div class="movements_amount">
                <?php if($row['tr_type']=="Deposit"){
                   echo "<div class='movements__row'>
                    <div class='movements__type movements__type--deposit'>
                        <i class='bx bxs-credit-card' value='Deposit'></i>
                    </div>
                    <div class='movs'>
                    <div class='movements-type'>{$row['tr_type']}</div>
                    <div class='movements__date'>$date - $time</div>
                    </div>
                    <div class='movements__value green'>+ ₹$tr_amt</div>
                </div>";
                }
                else if($row['tr_type']=="Withdraw"){
                echo "<div class='movements__row'>
                    <div class='movements__type movements__type--withdrawal'>
                        <i class='bx bx-download'></i>
                    </div>
                    <div class='movs'>
                    <div class='movements-type'>Withdrawal</div>
                    <div class='movements__date'>$date - $time</div>                                  
                    </div>
                    <div class='movements__value orange'>- ₹$tr_amt</div>
                </div>";
                }
                else if($row['tr_type']=="Transfer"){
                    echo "<div class='movements__row'>
                    <div class='movements__type movements__type--transfer'>
                        <i class='bx bx-transfer'></i>
                    </div>
                    <div class='movs'>
                    <div class='movements-type'>{$row['tr_type']}</div>
                    <div class='movements__date'>$date - $time</div>
                    </div>
                    <div class='movements__value orange'>- ₹$tr_amt</div>
                </div>";
                }else{
                    echo "<div class='movements__row'>
                    <div class='movements__type movements__type--transfer'>
                        <i class='bx bx-transfer'></i>
                    </div>
                    <div class='movs'>
                    <div class='movements-type'>{$row['tr_type']}</div>
                    <div class='movements__date'>$date - $time</div>
                    </div>
                    <div class='movements__value green'>+ ₹$tr_amt</div>
                </div>";
                }
                ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="log-out--model hidden">
        <h2 id="logout_head">Logout ?</h2>
        <ion-icon name="close" class="close-btn icon btn-ok" id="logout_cross"></ion-icon>
        <p id="logout_text">You will be redirected to Login page.</p>
        <div class="btn-container" id="logout-btns">
            <!-- <button class="confirm-btn" name="logout">Confirm</button> -->
            <a href="logout.php" class="confirm-btn">Confirm</a>
            <button class=" cancel-btn btn-ok">Cancel</button>
        </div>
    </div>
    <div class="log-out--model delete_model hidden">
        <h2 class="delete_head">Close ?</h2>
        <ion-icon name="close" class="close-btn icon btn-ok" id="delete_btn"></ion-icon>
        <p class="delete_text">Do you really want to close your account?</p>
        <div class="btn-container" id="btns">
            <button class="logout-btn">Confirm</button>
            <button class="cancel-btn btn-ok">Cancel</button>
        </div>
    </div>
    <div class="log-out--model transfer_model">
        <h2 id="process_id"></h2>
        <p class="transfer-msg"></p>
    </div>
    <div class="log-out--model loan_model">
        <h2 id="process_id2"></h2>
        <p class="transfer-msg2"></p>
    </div>
    <div class="overlay-main hidden">
        <img src="images/undraw_adventure_re_ncqp.svg" alt="" class="overlay-img left">
        <img src="images/undraw_ether_re_y7ft.svg" alt="" class="overlay-img right">
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
    <script>
    setInterval(showTime, 1000);

    function showTime() {
        const labelDate = document.querySelector(".date");
        const d = new Date();
        let day = `${d.getDate()}`.padStart(2, 0);
        let month = `${d.getMonth() + 1}`.padStart(2, 0);
        let year = d.getFullYear();
        const hour = `${d.getHours()}`.padStart(2, 0);
        const min = `${d.getMinutes()}`.padStart(2, 0);
        const sec = `${d.getSeconds()}`.padStart(2, 0);
        labelDate.textContent = `${day}/${month}/${year}, ${hour}:${min}:${sec}`;
    }
    showTime();
    window.onload = function() {
        var pieChart = new CanvasJS.Chart("pieChart", {
            exportEnabled: false,
            animationEnabled: true,
            backgroundColor: 'transparent',
            title: {
                text: "Total Transactions",
                fontColor: "#fff",
                fontWeight: 600,
                fontFamily: 'Poppins',
                fontSize: 22,
            },
            legend: {
                cursor: "pointer",
                fontColor: '#fff',
                fillStyle: 'white',
                fontFamily: 'Poppins',
                fontWeight: "normal",
                itemclick: explodePie
            },
            data: [{
                type: "pie",
                showInLegend: true,
                toolTipContent: "{name}: ₹ <strong>{y}</strong>",
                indexLabel: "{name} - ₹{y}",
                indexLabelFontColor: "white",
                indexLabelFontFamily: 'Poppins',
                indexLabelFontSize: 12,
                dataPoints: [{
                        y: <?php
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE tr_type ='Withdraw' ";
                  $stmt = $conn->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($Withdrawals);
                  $stmt->fetch();
                  $stmt->close();
                  if(empty($Withdrawals)){
                            echo 0;
                  }else{
                      echo $Withdrawals;
                  }
                  ?>,
                        name: "Withdrawals",
                        color: '#ffb732',
                        exploded: true
                    },

                    {
                        y: <?php
                  //return total number of transactions under  Deposits
                  
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE tr_type ='Deposit' ";
                  $stmt = $conn->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($Deposits);
                  $stmt->fetch();
                  $stmt->close();
                  if(empty($Deposits)){
                            echo 0;
                  }else{
                      echo $Deposits;
                  }
                  ?>,
                        name: "Deposits",
                        color: '#602560',
                        fontColor: '#fff',
                        exploded: true
                    },

                    {
                        y: <?php
                  //return total number of transactions under  Deposits
                  
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE tr_type ='Transfer' ";
                  $stmt = $conn->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($Transfers);
                  $stmt->fetch();
                  $stmt->close();
                  if(empty($Transfers)){
                            echo 0;
                  }else{
                      echo $Transfers;
                  }
                  ?>,
                        name: "Transfers",
                        color: '#11e7ff',
                        exploded: true
                    },

                    {
                        y: <?php
                  //return total number of transactions under  Deposits
                  
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE tr_type ='Recieved' ";
                  $stmt = $conn->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($Receives);
                  $stmt->fetch();
                  $stmt->close();
                        if (empty($Receives)) {
                            echo 0;
                        } else {
                            echo $Receives;
                        }
                  ?>,
                        name: "Recieved",
                        color: '#7ad4d4',
                        exploded: true
                    }
                ]
            }]
        });
        var accChart = new CanvasJS.Chart("accChart", {
            exportEnabled: false,
            animationEnabled: true,
            backgroundColor: 'transparent',
            title: {
                text: "Accounts Per Acc Types ",
                fontColor: "#fff",
                fontWeight: 600,
                fontFamily: 'Poppins',
                fontSize: 22,
            },
            legend: {
                cursor: "pointer",
                fontColor: '#fff',
                fillStyle: 'white',
                fontFamily: 'Poppins',
                fontWeight: "normal",
                itemclick: explodePie
            },
            data: [{
                type: "pie",
                showInLegend: true,
                toolTipContent: "{name}:",
                indexLabel: "{name} - {y}",
                indexLabelFontColor: "white",
                indexLabelFontFamily: 'Poppins',
                indexLabelFontSize: 12,
                dataPoints: [{
                        y: <?php
                                    $result = "SELECT COUNT(acc_type) FROM accounts WHERE acc_type ='Current' ";

                  $stmt = $conn->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($Current);
                  $stmt->fetch();
                  $stmt->close();
                  if(empty($Current)){
                            echo 0;
                  }else{
                      echo $Current;
                  }
                  ?>,
                        name: "Current Accounts",
                        color: '#ffb732',
                        exploded: true
                    },

                    {
                        y: <?php
                  //return total number of transactions under  Deposits
                  
                  $result = "SELECT COUNT(acc_type) FROM accounts WHERE acc_type ='Deposit' ";
                  $stmt = $conn->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($Deposits);
                  $stmt->fetch();
                  $stmt->close();
                  if(empty($Deposits)){
                            echo 0;
                  }else{
                      echo $Deposits;
                  }
                  ?>,
                        name: "Deposits Accounts",
                        color: '#602560',
                        fontColor: '#fff',
                        exploded: true
                    },

                    {
                        y: <?php
                  //return total number of transactions under  Deposits
                  
                  $result = "SELECT COUNT(acc_type) FROM accounts WHERE acc_type ='Savings' ";
                  $stmt = $conn->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($Savings);
                  $stmt->fetch();
                  $stmt->close();
                  if(empty($Savings)){
                            echo 0;
                  }else{
                      echo $Savings;
                  }
                  ?>,
                        name: "Savings Accounts",
                        color: '#11e7ff',
                        exploded: true
                    },
                ]
            }]
        });
        pieChart.render();
        accChart.render();
    }

    function explodePie(e) {
        if (typeof(e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e
                .dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();

    }
    </script>
    <script>
    // <?php include '../pages.js' ?>
    </script>
</body>

</html>