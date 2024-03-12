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
    <title>EaseBank &mdash; Account Details</title>
    <link rel="shortcut icon" href="../images/xing-logo-2447.png" type="image/x-icon">
    <style>
    <?php include '../css/pages.css'?>
    </style>
</head>

<body>
    <div class="container">
        <?php include 'dashboard.php'?>
        <div class="detail_box">
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
                $upi=$res['upi'];
                $profile=$res['profile_pic'];
                $gender=$res['gender'];
            }
            ?>
            <h2 class="head">Account Profile</h2>
            <div class="info_box">
                <div class="imgBox">
                    <img src="../profiles/<?php if(empty($profile)&&$gender=="M"){
            echo "male.webp";
            }else if(empty($profile)&&$gender=="F"){
            echo "female.webp";
            }else if(empty($profile)&&$gender=="N"){
            echo "profile.jpg";
            }else{
            echo $profile;
            }?>" alt="" class="profileImg">
                    <p class="profileName"><?php echo $acc_name?></p>
                    <p class="paymentName"><?php echo $upi?></p>
                </div>
                <div class="info_details">
                    <ul>
                        <li class="info_item"><strong>Acc No. </strong><span><?php echo $acc_num?></span></li>
                        <li class="info_item"><strong>Email </strong><span><?php echo $email?></span></li>
                        <li class="info_item"><strong>Phone </strong><span><?php echo $phone?></span></li>
                        <li class="info_item"><strong>Adhaar No. </strong><span><?php echo $adhaar?></span></li>
                        <li class="info_item"><strong>PAN No. </strong><span><?php echo $pan?></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php 
                        if(isset($_POST['changepwd'])){
                            $oldPwd= $_POST['oldpwd'];
                            $newPwd= $_POST['newpwd'];
                            $conpwd = $_POST['conpwd'];
                            if ($oldPwd != $newPwd && $oldPwd == $pwd && $newPwd == $conpwd) {
                                    $res = mysqli_query($conn, "UPDATE accounts SET pwd={$newPwd} WHERE acc_id=$acc_id");
                                    echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                                    <p>Account PIN updated successfully!.</p>
                                    </div>";
                                }
                                else{
                                    echo "<div class='error_msg' id='toast'><i class='bx bx-x-circle msg-icon'></i>
                                <p>Something went wrong!, Please try again later. Or check credentials.</p>
                                </div>";
                                }
                        }
                    ?>
        <div class="updateAcc">
            <h2 class="head">Update Profile</h2>
            <div class="details_box">
                <ul class="buttonPane">
                    <li class="nav_item active"><a href="#" class="nav_link" data-toggle="tab">Update Profile</a></li>
                    <li class="nav_item"><a href="#" class="nav_link" data-toggle="tab">Change PIN</a></li>
                </ul>
                <?php
                    if(isset($_POST['deletePic'])){
                        if($gender=='M'){
                            mysqli_query($conn, "UPDATE accounts SET profile_pic='male.webp' WHERE acc_id=$acc_id");
                        }else if($gender=='F'){
                            mysqli_query($conn, "UPDATE accounts SET profile_pic='female.webp' WHERE acc_id=$acc_id");
                        }else{
                            mysqli_query($conn, "UPDATE accounts SET profile_pic='profile.webp' WHERE acc_id=$acc_id");
                        }
                        // header("Location:details.php");
                                        echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                        <p>Profile Removed successfully!.</p>
                        </div>";
                    }
                ?>
                <div class="updateProfile tab-pane active">
                    <?php
                        if(isset($_POST['update'])){
                            $name=$_POST['name'];
                            $email = $_POST['email'];
                            $phone= $_POST['phone'];
                            $upi= $_POST['upi'];
                            $address= $_POST['address'];
                            $profileImg= $_FILES['image']['name'];
                            $tempName = $_FILES['image']['tmp_name'];
                            $folder = "../profiles/" . $profileImg;

                            mysqli_query($conn, "UPDATE accounts SET
                            acc_name='{$name}',email='{$email}',phone='{$phone}',upi='{$upi}',address='{$address}',profile_pic='{$profileImg}' WHERE acc_id=$acc_id");
                            move_uploaded_file($tempName, $folder);
                            mysqli_query($conn, "UPDATE transactions SET acc_name='{$name}' WHERE acc_id=$acc_id");
                            echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
                            <p>Account details updated successfully!.</p>
                            </div>";
                            // header("Location:details.php");
                        }            
                    ?>
                    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="formGrp">
                            <label for="">Name</label>
                            <input type="text" name='name' value="<?php echo $acc_name?>" required>
                        </div>
                        <div class="formGrp">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?php echo $email ?>" required>
                        </div>
                        <div class="formGrp">
                            <label for="">Phone No.</label>
                            <input type="text" name="phone" value="<?php echo $phone?>" required>
                        </div>
                        <div class="formGrp">
                            <label for="">UPI ID</label>
                            <input type="text" name="upi" value="<?php echo $upi ?>">
                        </div>
                        <div class="formGrp">
                            <label for="">Adhaar No.</label>
                            <input type="text" class="readonly" readonly value="<?php echo $adhaar?>">
                        </div>
                        <div class="formGrp">
                            <label for="">Address</label>
                            <input type="text" name="address" value="<?php echo $address?>" required>
                        </div>
                        <div class="formGrp">
                            <label for="">Profile Picture</label>
                            <input type="file" src="" alt="" id="chooseImg" accept="image/*" name="image">
                        </div>

                        <button class="updateDet" name="update">Update Account</button>
                        <button class="deleteBtn" name="deletePic">Remove Profile</button>
                    </form>
                </div>
                <div class="changePwd tab-pane">

                    <form method="post" autocomplete="off">
                        <div class="formGrp">
                            <label for="">Old Password</label>
                            <input type="password" name="oldpwd" maxlength="4" required>
                        </div>
                        <div class="formGrp">
                            <label for="">New Password</label>
                            <input type="password" name="newpwd" value="" maxlength="4" required>
                        </div>
                        <div class="formGrp">
                            <label for="">Confirm Password</label>
                            <input type="password" name="conpwd" value="" maxlength="4" required>
                        </div>
                        <button class="updateDet" name="changepwd">Change Pin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    <?php include '../js/pages.js' ?>
    </script>
</body>

</html>