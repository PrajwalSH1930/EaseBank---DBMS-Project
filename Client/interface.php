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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EaseBank &mdash; Dashboard</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
<!--     <script src="../plugins/canvasjs.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" integrity="sha512-FJ2OYvUIXUqCcPf1stu+oTBlhn54W0UisZB/TNrZaVMHHhYvLBV9jMbvJYtvDe5x/WVaoXZ6KB+Uqe5hT2vlyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container">
        <?php include 'dashboard.php';?>
        <?php 
            $acc_id = $_SESSION['acc_id'];
            $sql = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id=$acc_id");
            while ($res = mysqli_fetch_assoc($sql)) {
                $acc_id = $res['acc_id'];
                $acc_name = $res['acc_name'];
                $acc_num = $res['acc_num'];
                $pwd = $res['pwd'];
                $acc_type = $res['acc_type'];
            ?>
        <style>
        <?php include '../css/interface.css'?><?php include '../css/styles.css'?><?php include '../css/queries.css';

        include '../css/animation.css'?>hr {
            width: 1px;
            border: 1px solid #777;
            border-radius: 50%;
        }
        </style>
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

        $TotalBalInAccount = ($iB_deposits) - (($iB_withdrawal) + ($iB_Transfers)) + ($iB_receives);
        $income = ($iB_deposits) + ($iB_receives);
        $expense = ($iB_Transfers) + ($iB_withdrawal);
        $expenseIndication = round(($expense) / ($income) * 100, 2);
        $incomeIndication = 0;
        
        switch($acc_type){
            case 'Savings':$incomeIndication=round(($TotalBalInAccount)*.027,2);break;
            case 'Deposit':$incomeIndication=round(($TotalBalInAccount)*.03,2);break;
            case 'Current':$incomeIndication=0;break;
            default:
                $incomeIndication = 0;
        }
        ?>
        <div class="total_balance">
            <?php
            $mov = "SELECT tr_amt,tr_type,created_at,create_time FROM transactions WHERE acc_id=$acc_id ORDER BY tr_id DESC";
            $resMov = mysqli_query($conn, $mov);
            ?>
            <div class="balance_head_box">
                <h4 class="balance_head">Total Balance</h4>
                <div>
                    <i class="bx bx-down-arrow-circle"></i><span
                        class="expense_percent"><?php echo $expenseIndication . '%' ?></span>
                </div>
            </div>
            <h1 class="amount">₹<?php echo number_format((float) $TotalBalInAccount + $incomeIndication, 2, '.', ''); ?>
            </h1>
            <div class="expenditure">
                <div class="income">
                    <h6><i class="bx bxs-up-arrow"></i><span>Income</span></h6>
                    <h3 class="exp_amount income_amt">₹<?php echo number_format((float) $income, 2, '.', '') ?></h3>
                </div>
                <hr />
                <div class="expense">
                    <h6><i class="bx bxs-down-arrow"></i><span>Expenses</span></h6>
                    <h3 class="exp_amount expense_amt">₹<?php echo number_format((float) $expense, 2, '.', '') ?></h3>
                </div>
            </div>
        </div>
        <div class="savings">
            <div class="balance_head_box">
                <h4 class="balance_head">Total Savings</h4>
                <div>
                    <i class="bx bx-up-arrow-circle"></i><span class="savings_percent"><?php 
                        switch($acc_type){
                            case 'Savings':echo "2.70%";break;
                            case 'Deposit':echo "3.00%";break;
                            case 'Current':echo "0.00%";break;
                                        default:
                                            echo "0.00%";
                        }
                    ?></span>
                </div>
            </div>
            <h1 class="amount save_amt">
                <?php if($incomeIndication==0){
                    echo "
                        <div class='currentAcc'>
                            <p class='head'>Not Available!</p>
                            <p class='note'>(For Current Account Users)</p>
                        </div>
                    ";
                    }else{
                        echo "₹" . number_format((float) $incomeIndication, 2, '.', '');
                    } 
                ?></h1>
            <svg width="330" height="60">
                <g>
                    <rect class="bar" x="0" y="50" width="20" height="52.85781766650922"></rect>
                    <rect class="bar" x="30" width="20" y="40" height="52.85781766650922"></rect>
                    <rect class="bar" x="60" width="20" y="35" height="52.85781766650922"></rect>
                    <rect class="bar" x="90" width="20" y="30" height="52.85781766650922"></rect>
                    <rect class="bar" x="120" width="20" y="25" height="52.85781766650922"></rect>
                    <rect class="bar" x="150" width="20" y="18" height="57.85781766650922"></rect>
                    <rect class="bar" x="180" width="20" y="22" height="82.38639584317434"></rect>
                    <rect class="bar" x="210" width="20" y="15" height="82.38639584317434"></rect>
                    <rect class="bar" x="240" width="20" y="14" height="82.38639584317434"></rect>
                    <rect class="bar" x="270" width="20" y="10" height="82.38639584317434"></rect>
                    <rect class="bar" x="300" width="20" y="5" height="82.38639584317434"></rect>
                </g>
            </svg>
        </div>
        <?php } ?>
        <div class="exp_chart">
            <div class="chart_name">
                <h3>Statistics</h3>
                <p class="date">01/12/2023</p>
            </div>
            <div id="pieChart" style="height:330px;max-width:1000px;margin:20px auto;">
            </div>
        </div>

        <div class="movements_details">
            <h2>Transactions</h2>
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
        var AccChart = new CanvasJS.Chart("pieChart", {
            exportEnabled: false,
            animationEnabled: true,
            backgroundColor: 'transparent',
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
                indexLabelFontSize: 13,
                dataPoints: [{
                        y: <?php
                  //return total number of transactions under  Withdrawals
                  $client_id  = $_SESSION['acc_id'];
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE  tr_type ='Withdraw' AND acc_id =? ";
                  $stmt = $conn->prepare($result);
                  $stmt->bind_param('i', $client_id);
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
                  $client_id  = $_SESSION['acc_id'];
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE  tr_type ='Deposit' AND acc_id =? ";
                  $stmt = $conn->prepare($result);
                  $stmt->bind_param('i', $client_id);
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
                  $client_id  = $_SESSION['acc_id'];
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE  tr_type ='Transfer' AND acc_id =? ";
                  $stmt = $conn->prepare($result);
                  $stmt->bind_param('i', $client_id);
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
                  $client_id  = $_SESSION['acc_id'];
                  $result = "SELECT SUM(tr_amt) FROM transactions WHERE  tr_type ='Recieved' AND acc_id =? ";
                  $stmt = $conn->prepare($result);
                  $stmt->bind_param('i', $client_id);
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
                    },
                    {
                        y: <?php
                        echo $incomeIndication;
                            ?>,
                        name: 'Interest',
                        color: '#999',
                        exploded: true
                    }
                ]
            }]
        });
        AccChart.render();
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
    <?php include '../js/pages.js' ?>
    </script>
</body>

</html>
