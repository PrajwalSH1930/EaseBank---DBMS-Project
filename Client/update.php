<?php

    session_start();
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if(!isset($_SESSION['valid'])){
        header('Location:../index.php');
    }
    $acc_id = $_SESSION['acc_id'];
    $sql = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id=$acc_id");
    while($res=mysqli_fetch_assoc($sql)){
        $acc_id = $res['acc_id'];
        $gender=$res['gender'];
        $acc_name=$res['acc_name'];
    }

if(isset($_POST['update'])){
    $name=$_POST['name'];
    $email = $_POST['email'];
    $phone= $_POST['phone'];
    $upi= $_POST['upi'];
    $address= $_POST['address'];
    $profileImg= $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];
    $folder = '../profiles/' . $profileImg;

    mysqli_query($conn, "UPDATE accounts SET
    acc_name='{$name}',email='{$email}',phone='{$phone}',upi='{$upi}',address='{$address}',profile_pic='{$profileImg}' WHERE acc_id=$acc_id");

    if(move_uploaded_file($tempName, $folder)){
        echo "File uploaded!";
    }else{
        echo "Error!";
    }
    mysqli_query($conn, "UPDATE transactions SET acc_name='{$name}' WHERE acc_id=$acc_id");
    echo "<div class='success_msg' id='toast'><i class='bx bx-check-circle msg-icon'></i>
    <p>Account details updated successfully!.</p>
    </div>";
    header("Location:details.php");
}

if(isset($_POST['deletePic'])){
    if($gender=='M'){
        mysqli_query($conn, "UPDATE accounts SET profile_pic='male.webp' WHERE acc_id=$acc_id");
    }else if($gender=='F'){
        mysqli_query($conn, "UPDATE accounts SET profile_pic='female.webp' WHERE acc_id=$acc_id");
    }else{
        mysqli_query($conn, "UPDATE accounts SET profile_pic='profile.webp' WHERE acc_id=$acc_id");
    }
    header("Location:details.php");
}

if(isset($_POST['cardSub'])){
    $cardNum=str_replace(' ','',$_POST['cardNum']);
    $cardExpire=$_POST['cardExpire'];
    $cardYear=$_POST['cardYear'];
    $cvv=$_POST['cvv'];
    $cardImg= $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    $folder = 'cardImages/' . $cardImg;
    

        mysqli_query($conn, "INSERT INTO cards(acc_id,card_num,card_holder,cvv,expires,bg_pic) VALUES ('{$acc_id}','{$cardNum}','{$acc_name}','{$cvv}','{$cardExpire}/{$cardYear}','{$cardImg}')");
    if(move_uploaded_file($temp, $folder)){
        echo "File uploaded!";
    }else{
        echo "Error!";
    }
    header("Location:card.php");
    
    
}

if (!empty($_POST["acc_num"])) {
    $acc_num = $_POST['acc_num'];
    $res = mysqli_query($conn, "SELECT * FROM accounts WHERE acc_num=$acc_num");

    while ($row = mysqli_fetch_assoc($res)) {
?>
<?php echo htmlentities($row['acc_name']); ?>
<?php
    }
}