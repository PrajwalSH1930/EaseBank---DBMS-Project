<?php 
    include('connection.php');
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $search_value = $_POST["search"];
    $sql="SELECT * FROM transactions WHERE 
    tr_code LIKE '%{$search_value}%' OR 
    acc_num LIKE '%{$search_value}%' OR
    tr_type LIKE '%{$search_value}%' OR
    tr_amt LIKE '%{$search_value}%' OR
    acc_name LIKE '%{$search_value}%' OR
    created_at LIKE '%{$search_value}%' OR
    create_time LIKE '%{$search_value}%'";
    $res = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($res)>0){
        $i = 1;
        while($row = mysqli_fetch_assoc($res)){
            $tr_amt = number_format((float) $row['tr_amt'], 2, '.', '');
            $date=date('M d, y',strtotime($row['created_at']));
            $time=date('h:i A',strtotime($row['create_time']));
            $output .= "
            <tr>
                <td>{$i}</td>
                <td>{$row['tr_code']}</td>
                <td>{$row['acc_num']}</td>
                <td><b>{$row['tr_type']}</b></td>
                <td>{$tr_amt}</td>
                <td>{$row['acc_name']}</td>
                <td>{$date}, {$time}</td>
            </tr>
            
            ";
            $i+=1;
        }
        echo $output;
    }else{
        echo "<h2 align='center'>No records found!</h2>";
    }

?>