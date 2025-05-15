<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
    $sql = "Select * from users where username='$username' AND userType='1'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])){ 
                session_start();
                $_SESSION['adminloggedin'] = true;
                $_SESSION['adminusername'] = $username;
            $_SESSION['adminuserId'] = $row['id'];
            header("location: /OnlinePizzaDelivery/admin/index.php");
                exit();
            } 
            else{
            header("location: /OnlinePizzaDelivery/admin/login.php?loginsuccess=false");
            exit();
        }
    } 
    else{
        header("location: /OnlinePizzaDelivery/admin/login.php?loginsuccess=false");
        exit();
    }
}    
?>