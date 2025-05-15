<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["loginusername"];
    $password = $_POST["loginpassword"]; 
    
    $sql = "Select * from users where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])){ 
            session_start();
            
            if($row['userType'] == '1') { // Admin user
                $_SESSION['adminloggedin'] = true;
                $_SESSION['adminusername'] = $username;
                $_SESSION['adminuserId'] = $row['id'];
                header("location: /OnlinePizzaDelivery/admin/index.php");
                exit();
            } else { // Regular user
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
                $_SESSION['userId'] = $row['id'];
            header("location: /OnlinePizzaDelivery/index.php?loginsuccess=true");
            exit();
            }
        } 
        else{
            header("location: /OnlinePizzaDelivery/login.php?loginsuccess=false");
            exit();
        }
    } 
    else{
        header("location: /OnlinePizzaDelivery/login.php?loginsuccess=false");
        exit();
    }
}    
?>