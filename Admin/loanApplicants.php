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
    <title>EaseBank &mdash; Loan Applicants</title>
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
        <?php include 'adminDashboard.php' ?>
        <div class="loanBar">
            <h2 class="head">Loan Applications</h2>
            <div class="accordion">
                <?php
                    $sql = mysqli_query($conn, 
                    "SELECT A.* , L.* 
                    FROM accounts A,loan L 
                    WHERE A.acc_id = L.acc_id");
                    $i = 1;
                    while($row=mysqli_fetch_assoc($sql)){
                ?>
                <div class="accordion_content">
                    <header class="accordion_header">
                        <?php 
                            if(isset($_POST['approve'])){
                                echo "<div class='seal approved'>
                                <h1 class='sealHead'>Approved</h1>
                            </div>";
                                $acc_id=$_POST['approve'];
                                $_transcode =  rand(100000000000,199999999999);
                                $tr_amt = number_format((float) $row['amount'], 2, '.', '');
                                $date = date('d-m-Y H:i:s');
                                $message = "A/c {$row['acc_num']}, Your loan application is Approved -EaseBank.";
                                $message2 = "A/c {$row['acc_num']}, Credited for {$row['amount']} on $date by Deposit ref no $_transcode - EaseBank.";
                                mysqli_query($conn, "INSERT INTO transactions(tr_code,acc_id,acc_name,acc_num,acc_type,tr_type,tr_amt) VALUES ('{$_transcode}','{$acc_id}','{$row['acc_name']}','{$row['acc_num']}','{$row['acc_type']}','Deposit','{$tr_amt}')");
                                mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$message}')");
                                mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$message2}')");
                                echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                                <p>A/c {$row['acc_num']}, Your loan application is Approved -EaseBank.</p>
                                </div>";
                                usleep(5);
                                mysqli_query($conn, "DELETE FROM loan WHERE acc_id=$acc_id");
                            } elseif (isset($_POST['reject'])) {
                                echo "<div class='seal rejected'>
                                    <h1 class='sealHead'>Rejected</h1>
                                </div>";
                                $acc_id=$_POST['reject'];
                                $message = "A/c {$row['acc_num']}, Your loan application is Rejected -EaseBank.";
                                mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$message}')");
                                echo "<div class='invalid_msg' id='toast'><i class='bx bx-error-circle msg-icon'></i>
                                <p>A/c {$row['acc_num']}, Your loan application is Rejected -EaseBank.</p>
                                </div>";
                                usleep(5);
                                mysqli_query($conn, "DELETE FROM loan WHERE acc_id=$acc_id");
                            }
                        ?>
                        <div>
                            <span class="title"><?php echo "$i. ". $row['acc_name']; ?></span>
                        </div>
                        <form action="" method="post" class="buttonForm" name="buttonForm">
                            <button class=" updateDet" id="approve" name="approve" style="width:100px;"
                                value="<?=$row['acc_id']?>">Approve</button>
                            <button class="deleteBtn" id="reject" name="reject" style="width:100px;"
                                value="<?=$row['acc_id']?>">Reject</button>
                            <i class='bx bx-chevron-down' style="margin-left:16px;"></i>
                        </form>
                    </header>
                    <div class="accordion_desc">
                        <table class="loanTable" cellspacing=0>
                            <tbody>
                                <tr>
                                    <th colspan='8' class="heading">Personal Details</th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td colspan='2'><?php echo $row['acc_name']?></td>
                                    <th>Gender</th>
                                    <td><?php echo $row['gender']?></td>
                                    <th>Salutations</th>
                                    <td><?php
                                    $gender = $row['gender'];
                                    if ($gender == 'M')
                                        echo "Mr";
                                    elseif ($gender == 'F')
                                        echo 'Ms/Mrs';
                                    else
                                        echo 'Mr/Mrs';
                                    ?></td>
                                    <td rowspan="3" class="profileImg"><img
                                            src="../profiles/<?php echo $row['profile_pic'];?>" alt=""></td>
                                </tr>
                                <tr>
                                    <?php 
                                        $dob=$row['dob'];
                                        $today=date('Y-m-d');
                                        $diff = date_diff(date_create($dob), date_create($today));
                                    ?>
                                    <th>Date of Birth</th>
                                    <td colspan='2'><?php echo $dob?></td>
                                    <th>Age</th>
                                    <td><?php echo $diff->format('%y').' yrs'?></td>
                                    <td><?php echo $diff->format('%m').' months'?></td>
                                    <td><?php echo $diff->format('%d').' days'?></td>
                                </tr>
                                <tr>
                                    <th>Marital Status</th>
                                    <td colspan='2'><?php
                                        echo $row['civil_status']
                                    ?></td>
                                    <th>Name of Spouse</th>
                                    <td colspan='4'></td>
                                </tr>
                                <tr>
                                    <th>Education</th>
                                    <td colspan='2'><?php echo $row['education']?></td>
                                    <th>Employment</th>
                                    <td colspan='2'><?php echo $row['employment']?></td>
                                    <th>Account Type</th>
                                    <td colspan='2'><?php echo $row['acc_type']?></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td colspan='2'><?php echo $row['phone']?></td>
                                    <th>Email</th>
                                    <td colspan='2'><?php echo $row['email']?></td>
                                    <th>PAN Number</th>
                                    <td colspan='2'><?php echo $row['pan']?></td>
                                </tr>
                                <tr>
                                    <th>Adhaar Number</th>
                                    <td colspan='2'><?php echo $row['adhaar']?></td>
                                    <th>Address</th>
                                    <td colspan='4'><?php echo $row['address']?></td>
                                </tr>
                                <tr>
                                    <th>Present Address</th>
                                    <td colspan='3'><?php echo $row['address']?></td>
                                    <th>Permanent Address</th>
                                    <td colspan='3'><?php echo $row['address']?></td>
                                </tr>
                                <tr>
                                    <th colspan='8' class="heading">Partnership / Corporation</th>
                                </tr>
                                <tr>
                                    <th>Partner Name</th>
                                    <td colspan='2'><?php echo $row['p_name'] ?></td>
                                    <th>Partner Phone</th>
                                    <td colspan=''><?php echo $row['p_phone'] ?></td>
                                    <th>Partner Email</th>
                                    <td colspan='2'><?php ?></td>
                                </tr>
                                <tr>
                                    <th>Partner Address</th>
                                    <td colspan='3'><?php echo $row['p_address']?></td>
                                    <th>Partner Permanent Address</th>
                                    <td colspan='3'><?php echo $row['p_address']?></td>
                                </tr>
                                <tr>
                                    <th>Relation with partner</th>
                                    <td colspan='3'><?php echo $row['relation'] ?></td>
                                    <th>Partner Designation</th>
                                    <td colspan='3'></td>
                                </tr>
                                <tr>
                                    <th colspan='8' class="heading">Loan Details</th>
                                </tr>
                                <tr>
                                    <th>Loan Amount</th>
                                    <td colspan='2'><?php echo $row['amount'] ?></td>
                                    <th>Purpose of Loan</th>
                                    <td colspan='4'><?php echo $row['purpose']?></td>
                                </tr>
                                <tr>
                                    <th>Facility</th>
                                    <td colspan='2'><?php echo $row['facility']?></td>
                                    <th>Repayment Method</th>
                                    <td><?php echo $row['repayment']?></td>
                                    <th>Term</th>
                                    <td colspan='2'><?php echo $row['term'].' years'?></td>
                                </tr>
                                <tr>
                                    <?php
                                        $tr_code =  rand(100000000000,199999999999);
                                    ?>
                                    <th>Transaction ID</th>
                                    <td colspan='3' value="<?php echo $tr_code ?>">XXXXXXXXXXXX</td>
                                    <th>Deposit Account Number</th>
                                    <td colspan='3'><?php echo $row['acc_num'] ?></td>
                                </tr>
                                <tr>
                                    <th colspan='8' class="heading">Declaration</th>
                                </tr>
                                <tr>
                                    <td colspan='8'>
                                        <p>
                                            I/we declare that all the particulars and information given in the
                                            application
                                            form or true, correct and they shall form the basis of any loan Union Bank
                                            of
                                            India (Union Bank) may decide
                                            to grant me/us. I/we confirm that I/we have no insolvency proceedings
                                            against
                                            me/us nor have I/we ever been adjudged insolvent and further confirm that
                                            I/we
                                            have read the brochure
                                            and understood the contents. I am/we are aware that the equated monthly
                                            instalment comprising principal and interest is calculated on the basis of
                                            monthly rests. <br><br>
                                            I/we agree that Bank may take up such reference and may make such enquiries
                                            in
                                            respect of this application as it may deem necessary. I/we undertake to
                                            inform
                                            the Bank regarding
                                            any change in my/our occupation/employment and to provide any further
                                            information that the Bank may require. UNION BANK may make available any
                                            information contained in this
                                            form, other documents submitted to Union Bank and information pertaining to
                                            the
                                            loan to any Institution or body. The Bank may seek or receive information
                                            from
                                            any source/person to
                                            consider this application. I/we further agree that my/our loan shall be
                                            governed
                                            by rules of Union Bank of India which may be in force from time to
                                            time.<br><br>
                                            I/We authorize Union Bank of India to exchange, share or part with all the
                                            information relating to my/our loan details/repayment history/information to
                                            other Union Bank Branches/
                                            other Banks/Financial Institutions/Reserve Bank of India/ Credit Bureau
                                            Agencies/Statutory Bodies as may be required and shall not hold Union Bank
                                            of
                                            India and/or its agents liable
                                            for use of this information.<br><br>
                                            I/we further declare and agree that the information furnished here in above
                                            is
                                            true to the best of our knowledge and belief and in case any information is
                                            found to be false at a later date,
                                            the bank has right to recall the advance and initiate appropriate action as
                                            it may deem fit.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <p>Name :</p>
                                            <p>Date :</p>
                                        </div>
                                    </td>
                                    <td colspan="5">
                                        <div>
                                            <p><?php echo $row['acc_name'] ?></p>
                                            <p><?php echo $row['created_at'] ?></p>
                                        </div>
                                    </td>
                                    <td colspan='2' align="center">
                                        <h1 class='sign' style="  font-size: 32px;">SIGNED</h1>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $i++; } ?>
            </div>
        </div>
    </div>
    <!-- <script src="../pages.js"></script> -->
    <script>
    <?php include '../js/pages.js' ?>
    </script>

</body>

</html>