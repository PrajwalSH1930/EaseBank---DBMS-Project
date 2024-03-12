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
<?php 
if(isset($_POST['delete'])){
                    $new_num=$_POST['acc_num'];
                    $pin = $_POST['pass'];
                    $confPin = $_POST['conPass'];
                    $reason = $_POST['reason'];
                    $reason2 = $_POST['reasonOther'];
                    if($reason=='Others'){
                        $reason = $reason2;
                    }
                    if($pin == $confPin && $pin == $pwd && $acc_num == $new_num){
                        mysqli_query($conn, "INSERT INTO deleted_accs(acc_id,acc_num,reason) VALUES ('{$acc_id}','{$acc_num}','{$reason}')");
                        mysqli_query($conn, "DELETE FROM accounts WHERE acc_num=$acc_num AND pwd=$pin");
                        session_destroy();
                        unset($_SESSION['valid']);
                        header("Location:../index.php");
                    }else{
                        echo "<div class='error_msg' id='toast'><i class='bx bx-x-circle msg-icon'></i>
                            <p>Something went wrong. Please try again later!</p>
                        </div>";
                    }
                }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EaseBank &mdash; Settings</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <style>
    <?php include '../css/pages.css'?>
    </style>
</head>

<body>
    <div class="container">
        <?php include 'dashboard.php'?>
        <div class="profileBox">
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
                $adhaar=$res['adhaar'];
                $email = $res['email'];
                $address=$res['address'];
                $dob = $res['dob'];
                $created_at = explode(" ",$res['created_at']);
                $date = $created_at[0];
                $upi = $res['upi'];
                $profile=$res['profile_pic'];
                $gender=$res['gender'];          
            }
            
            ?>
            <h2 class="head">Account Settings</h2>
            <div class="accountDetails">
                <p class="headInfo head">Personal & Account info</p>
                <ul>
                    <li>
                        <div class="proInfo">
                            <img src="../profiles/<?php 
                            if(empty($profile) && $gender=="M"){
                                echo "male.webp";
                            }else if(empty($profile) && $gender=="F"){
                                echo "female.webp";
                            }else if(empty($profile) && $gender=="N"){
                                echo "profile.jpg";
                            }else{
                                echo $profile;
                            } ?>" alt="" class="detImg">
                            <div>
                                <p class="proName"><?php echo $acc_name ?></p>
                                <p class="bankId"><?php echo $upi?></p>
                            </div>
                        </div>
                    </li>
                    <li class="info_item"><strong>Acc No :</strong><span><?php echo $acc_num?></span></li>
                    <li class="info_item"><strong>Acc Type : </strong><span><?php echo $acc_type." Account"?></span>
                    </li>
                    <li class="info_item"><strong>Phone :</strong><span><?php echo $phone?></span></li>
                    <li class="info_item"><strong>Email :</strong><span><?php echo $email?></span></li>
                    <li class="info_item"><strong>Date of Birth : </strong><span><?php echo $dob?></span></li>
                    <li class="info_item"><strong>Adhaar No. :</strong><span><?php echo $adhaar?></span></li>
                    <li class="info_item"><strong>PAN No. : </strong><span><?php echo $pan?></span></li>
                    <li class="info_item"><strong>Address :</strong><span><?php echo $address?></span></li>
                    <li class="info_item"><strong>Created At
                            :</strong><span><?php echo $date?></span></li>
                </ul>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion_content">
                <header class="accordion_header">
                    <span class="title">About us</span>
                    <i class='bx bx-chevron-down'></i>
                </header>
                <p class="accordion_desc">
                    At EaseBank, we’re committed to cultivating a diverse and inclusive workplace and focusing on
                    partnerships that drive change and address critical challenges facing our communities. Creating an
                    inclusive environment starts at the top and extends to all of our company. Our Board, its committees
                    and our CEO play a key role in the oversight of our culture, holding management accountable for
                    ethical and professional conduct and a commitment to being a diverse and inclusive
                    workplace.<br><br>
                    We view this work as key to our role in society. It’s fundamental to how we run our company, support
                    our teammates and deliver for clients. We know these efforts are not enough to end the racial
                    inequality that still impacts our communities today. But together, through partnerships that bring
                    together leaders from business, government, and the nonprofit and academic worlds, we can continue
                    to drive progress and create more opportunity for all.
                </p>
            </div>
            <div class="accordion_content">
                <header class="accordion_header">
                    <span class="title">Privacy Policy</span>
                    <i class='bx bx-chevron-down'></i>
                </header>
                <div class="accordion_desc">
                    <p>At U.S. Bancorp®, trust has always been the foundation of our relationship with
                        customers. Because you trust us with your financial and other personal information, we respect
                        your
                        privacy and safeguard your information. In order to preserve that trust, the U.S. Bancorp family
                        of
                        financial service providers pledges to protect your privacy by adhering to the practices
                        described
                        below.<br><br>
                        The U.S. Bank—Dealer Financial Services Privacy Policy only applies to U.S.
                        Bank—Dealer Financial Services customers who are NOT residents of California, North Dakota or
                        Vermont
                        and who leased or purchased a vehicle and obtained U.S. Bank financing through an automotive
                        dealership.</p>
                </div>
            </div>
            <div class="accordion_content">
                <header class="accordion_header">
                    <span class="title">Terms of Use & Services</span>
                    <i class='bx bx-chevron-down'></i>
                </header>
                <div class="accordion_desc">
                    <ol class="terms-list">
                        <li class="terms-li">These website terms of use explain legal aspects of our website and your
                            use of it.
                            Your use of our website indicates your acceptance of these website terms of use.</li>
                        <li class="terms-li">These website terms of use incorporate EaseBank’s privacy policy.</li>
                        <li class="terms-li">Copyright and other intellectual property in our website belongs to
                            EaseBank</li>
                        <li class="terms-li">You must not use or distribute any information, images, screens, web pages,
                            logos
                            or brands from our website in any public way (including reproduction on the Internet or
                            digital
                            copies) without EaseBank’s written permission.</li>
                        <li class="terms-li">EaseBank may amend or add to our website, including interest rates shown on
                            our
                            website, at any time.</li>
                        <li class="terms-li">EaseBank is not, in this website, making any offer to enter into any
                            transaction or
                            relationship with you. You should visit or call EaseBank for details of up-to-date service
                            information, charges, interest rates, terms and conditions.</li>
                        <li class="terms-li">EaseBank may use any suggestions you make for changes to this website,
                            without any
                            obligation to you.</li>
                        <li class="terms-li">Only authorised users of EaseBank’s internet banking, or mobile app,
                            services may
                            access those services. Legal action may be taken against unauthorised users.</li>
                        <li class="terms-li">EaseBank may change these website terms of use at any time. EaseBank will
                            usually
                            give at least 14 days’ notice of changes, by publishing them on our website. Your continued
                            use of
                            our website will indicate acceptance of the amended website terms of use.</li>
                    </ol>
                </div>
                </p>
            </div>
            <div class="accordion_content">
                <header class="accordion_header">
                    <span class="title">Contact us</span>
                    <i class='bx bx-chevron-down'></i>
                </header>
                <div class="accordion_desc">
                    <ul class="contactUs">
                        <li>
                            <a href="mailto:easebank.princeinc@gmail.com" target="_blank">
                                <div> Mail us<i class='bx bxl-google'></i></div> <i class='bx bx-link'></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/_prajwalhiremath.ig/" target="_blank">
                                <div>Follow us on<i class='bx bxl-instagram'></i></div><i class='bx bx-link'></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/prajwal.hiremath.9237" target="_blank">
                                <div>Follow us on<i class='bx bxl-facebook'></i></div><i class='bx bx-link'></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/Prince193067" target="_blank">
                                <div>Follow us on<i class='bx bxl-twitter'></i></div><i class='bx bx-link'></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/PrinceSH21" target="_blank">
                                <div>
                                    Follow us on<i class='bx bxl-github'></i>
                                </div><i class='bx bx-link'></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="accordion_content">
                <header class="accordion_header">
                    <span class="title">Help ?</span>
                    <i class='bx bx-chevron-down'></i>
                </header>
                <div class="accordion_desc help">
                    <h1>How can we help you?</h1>
                </div>
            </div>
            <div class="accordion_content">
                <header class="accordion_header">
                    <span class="title">Delete Account</span>
                    <i class='bx bx-chevron-down'></i>
                </header>

                <div class="accordion_desc help">
                    <form action="" method="post" autocomplete="off">
                        <div class="formGrp">
                            <label for="">Acc No</label>
                            <input type="text" name='acc_num' required>
                        </div>
                        <div class="formGrp">
                            <label for="">Pin</label>
                            <input type="password" name="pass" required>
                        </div>
                        <div class="formGrp">
                            <label for="">Confirm Pin</label>
                            <input type="password" name="conPass" required>
                        </div>
                        <div class="formGrp">
                            <label for="">Reason</label>
                            <select name="reason" id="selector" onchange="toggleTextarea()">
                                <option value="">Select the Reason</option>
                                <option value="Poor Customer Service">Poor Customer Service</option>
                                <option value="Switching Banks">Switching Banks</option>
                                <option value="Requirement and Fees">Requirement and Fees</option>
                                <option value="High Minimum deposit">High Minimum deposit</option>
                                <option value="Inactivity">Inactivity</option>
                                <option value="Others">Others</option>
                            </select>
                            <input type="text" name="reasonOther" id="dynamicTextarea"
                                placeholder="Enter Your reason here" required>
                        </div>
                        <button class="deleteAcc" name="delete">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js'?>

    function toggleTextarea() {
        var select = document.getElementById('selector'),
            textarea = document.getElementById('dynamicTextarea');

        if (select.value === 'Others') {
            textarea.style.display = "block";
            select.style.display = "none";
        } else {
            textarea.style.display = "none";
            select.style.display = "block";

        }
    }
    </script>
</body>

</html>