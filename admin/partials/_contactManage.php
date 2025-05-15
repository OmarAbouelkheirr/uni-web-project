<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['sendReply'])) {
        $contactId = $_POST['contactId'];
        $message = $_POST['replyMessage'];
        // Fetch userId from contact table
        $result = mysqli_query($conn, "SELECT userId FROM contact WHERE contactId = '$contactId'");
        $row = mysqli_fetch_assoc($result);
        $userId = $row['userId'];
        $sql = "INSERT INTO `contactreply` (`contactId`, `userId`, `message`, `datetime`) VALUES ('$contactId', '$userId', '$message', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "<script>alert('success');\nwindow.location=document.referrer;\n</script>";
        }
        else {
            echo "<script>alert('failed');\nwindow.location=document.referrer;\n</script>";
        }
    }
    if(isset($_POST['deleteMessage'])) {
        $contactId = $_POST['contactId'];
        $sql = "DELETE FROM `contact` WHERE `contactId`='$contactId'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "<script>alert('Deleted');\nwindow.location=document.referrer;\n</script>";
        } else {
            echo "<script>alert('Delete failed');\nwindow.location=document.referrer;\n</script>";
        }
    }
}
?>