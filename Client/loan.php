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
    <title>EaseBank &mdash; Loan</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
    <?php include '../css/pages.css'?>
    </style>
</head>

<body>
    <div class="container">
        <?php include 'dashboard.php'?>
        <?php
        $acc_id = $_SESSION['acc_id'];
        $sql = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id=$acc_id");
            while($res=mysqli_fetch_assoc($sql)){
                $acc_id = $res['acc_id'];
                $acc_name = $res['acc_name'];
                $acc_num=$res['acc_num'];
                $acc_type=$res['acc_type'];
                $phone=$res['phone'];
                $pan=$res['pan'];
                $pwd=$res['pwd'];
                $upi=$res['upi'];
                $adhaar=$res['adhaar'];
                $address=$res['address'];
                $dob = $res['dob'];
                $gender = $res['gender'];
            }
        ?>
        <div class="loan">
            <?php 
                if(isset($_POST['loan'])){
                    $education = $_POST['education'];
                    $civil_status = $_POST['civil_status'];
                    $employment = $_POST['employment'];
                    $partner_name = $_POST['partner-name'];
                    $partner_phone=$_POST['partner-phone'];
                    $partner_address = $_POST['partner-address'];
                    $relation = $_POST['relation'];
                    $partner_des = $_POST['partner-des'];
                    $amount=$_POST['amount'];
                    $purpose = $_POST['purpose'];
                    $facility = $_POST['facility'];
                    $repayment = $_POST['repayment'];
                    $term=$_POST['term'];
                    $message = "A/c $acc_num, Your application for loan is successfully submitted -EaseBank.";
                    mysqli_query($conn, "INSERT INTO loan(acc_id,amount,purpose,education,civil_status,employment,p_name,p_phone,p_address,relation,facility,repayment,term) 
                    VALUES ('{$acc_id}','{$amount}','{$purpose}','{$education}','{$civil_status}','{$employment}','{$partner_name}','{$partner_phone}','{$partner_address}','{$relation}','{$facility}','{$repayment}','{$term}')");
                    mysqli_query($conn, "INSERT INTO notifications(acc_id,not_desc) VALUES ('{$acc_id}','{$message}')");
                    echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                        <p>A/c $acc_num, Your application for loan is successfully submitted -EaseBank.</p>
                        </div>";
                }          
            ?>
            <div class="loan_form" autocomplete="off">
                <h2 class="secondary_head">Apply for Loan Form</h2>
                <form method="post" action="" autocomplete="off">
                    <h2 class="form_head">Borrower Information</h2>
                    <div class="grid-3-cols">
                        <div class="transfer_div">
                            <label for="">Client Name</label>
                            <input type="text" readonly value="<?php echo $acc_name?>" required class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">Client PAN Number</label>
                            <input type="text" readonly value="<?php echo $pan?>" required class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">Client Adhaar Number</label>
                            <input type="text" readonly value="<?php echo $adhaar?>" required class="readonly">
                        </div>
                    </div>
                    <div class="grid-3-cols">
                        <div class="transfer_div">
                            <label for="">Account Name</label>
                            <input type="text" readonly required value="<?php echo $acc_name?>" class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">UPI ID</label>
                            <input type="text" readonly required value="<?php echo $upi?>" class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">Client Phone Number</label>
                            <input type="text" readonly value="<?php echo $phone?>" required class="readonly">
                        </div>
                    </div>
                    <div class="grid-3-cols">
                        <div class="transfer_div">
                            <label for="">Address</label>
                            <input type="text" readonly required value="<?php echo $address?>" class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">Gender</label>
                            <input type="text" readonly required value="<?php echo $gender?>" class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">Date of Birth</label>
                            <input type="text" readonly value="<?php echo $dob?>" required class="readonly">
                        </div>
                    </div>
                    <div class="grid-2-cols">
                        <div class="transfer_div">
                            <label for="">Account Number</label>
                            <input type="text" readonly required value="<?php echo $acc_num?>" class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">Account Type | Category</label>
                            <input type="text" readonly required value="<?php echo $acc_type?>" class="readonly">
                        </div>
                    </div>
                    <div class="grid-3-cols">
                        <div class="transfer_div">
                            <label for="">Highest Educational Attainment</label>
                            <select name="education" id="" required>
                                <option value="">Select Education</option>
                                <option value="Highschool Graduate">Highschool Graduate</option>
                                <option value="College Undergraduate">College Undergraduate</option>
                                <option value="College Graduate">College Graduate</option>
                                <option value="Post Graduate">Post Graduate</option>
                            </select>
                        </div>
                        <div class="transfer_div">
                            <label for="">Civil Status</label>
                            <select name="civil_status" id="" required>
                                <option value="">Select Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widow">Widow</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="transfer_div">
                            <label for="">Employment</label>
                            <select name="employment" id="" required>
                                <option value="">Select Status</option>
                                <option value="Employed">Employed</option>
                                <option value="Self Employed">Self Employed</option>
                                <option value="Unemployed">Unemployed</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <h2 class="form_head">Partnership / Corporation</h2>
                    <div class="grid-3-cols">
                        <div class="transfer_div">
                            <label for="">Partnership / Corporation Name</label>
                            <input type="text" name="partner-name">
                        </div>
                        <div class="transfer_div">
                            <label for="">Contact No.</label>
                            <input type="text" name="partner-phone" pattern="{1-9}">
                        </div>
                        <div class="transfer_div">
                            <label for="">Relation</label>
                            <input type="text" name="relation">
                        </div>
                    </div>
                    <div class="grid-2-cols">
                        <div class="transfer_div">
                            <label for="">Address</label>
                            <input type="text" name="partner-address">
                        </div>
                        <div class="transfer_div">
                            <label for="">Position / Designation</label>
                            <input type="text" name="partner-des" id="">
                        </div>
                    </div>
                    <br>
                    <h2 class="form_head">Loan Information</h2>
                    <div class="grid-2-cols">
                        <?php
                            $_transcode =  rand(100000000000,199999999999);
                        ?>
                        <div class="transfer_div">
                            <label for="">Loan Amount applied for(₹)</label>
                            <input type="text" required pattern="{1-9}" name='amount'>
                        </div>
                        <div class="transfer_div">
                            <label for="">Purpose of the Loan</label>
                            <input type="text" name='purpose'>
                        </div>
                    </div>
                    <div class="grid-3-cols">
                        <div class="transfer_div">
                            <label for="">Facility</label>
                            <select name="facility" id="" required>
                                <option value="">Select Facility</option>
                                <option value="Term Loan">Term Loan</option>
                                <option value="Business Credit Line">Business Credit Line </option>
                            </select>
                        </div>
                        <div class="transfer_div">
                            <label for="">Repayment Method</label>
                            <select name="repayment" id="" required>
                                <option value="">Select Method</option>
                                <option value="PDC">PDC</option>
                                <option value="Auto-Debit">Auto-Debit</option>
                            </select>
                        </div>
                        <div class="transfer_div">
                            <label for="">Term</label>
                            <select name="term" id="" required>
                                <option value="">Select Term</option>
                                <option value="1">1 Years</option>
                                <option value="2">2 Years</option>
                                <option value="3">3 Years</option>
                                <option value="4">4 Years</option>
                                <option value="5">5 Years</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-2-cols">
                        <div class="transfer_div">
                            <label for="">Reference ID</label>
                            <input type="text" readonly required value="<?php echo $_transcode?>" class="readonly">
                        </div>
                        <div class="transfer_div">
                            <label for="">EaseBank Deposit Account No.</label>
                            <input type="text" readonly required value="<?php echo $acc_num?>" class="readonly">
                        </div>
                    </div>
                    <button type="submit" name="loan" class="transfer_btn">Apply Loan</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js'?>
    </script>
</body>

</html>