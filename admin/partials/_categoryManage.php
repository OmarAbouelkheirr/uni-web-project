<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['addCategory'])) {
        $name = $_POST["catName"];
        $desc = $_POST["catDesc"];

        $sql = "INSERT INTO `categories` (`categorieName`, `categorieDesc`, `categorieCreateDate`) VALUES ('$name', '$desc', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        $catId = $conn->insert_id;
        if($result) {
            $check = getimagesize($_FILES["catImage"]["tmp_name"]);
            if($check !== false) {
                
                $newfilename = "card-".$catId.".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/OnlinePizzaDelivery/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['catImage']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('success');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('failed to upload image');
                            window.location=document.referrer;
                        </script>";
                }

            }
            else{
                echo '<script>alert("Please select an image file to upload.");
                    window.location=document.referrer;
                    </script>';
            }
        }
    }
    if(isset($_POST['removeCategory'])) {
        $catId = $_POST["catId"];
        $filename = $_SERVER['DOCUMENT_ROOT']."/OnlinePizzaDelivery/img/card-".$catId.".jpg";
        $sql = "DELETE FROM `categories` WHERE `categorieId`='$catId'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            if (file_exists($filename)) {
                unlink($filename);
            }
            echo "<script>alert('Removed');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateCategory'])) {
        $catId = $_POST["catId"];
        $catName = $_POST["catName"];
        $catDesc = $_POST["catDesc"];

        $stmt = $conn->prepare("UPDATE `categories` SET `categorieName`=?, `categorieDesc`=? WHERE `categorieId`=?");
        $stmt->bind_param("ssi", $catName, $catDesc, $catId);
        $result = $stmt->execute();

        if ($result){
            echo "<script>alert('update');
                window.location=document.referrer;
                </script>";
        }
        else {
            $error = $stmt->error;
            echo "<script>alert('failed: " . addslashes($error) . "');
                window.location=document.referrer;
                </script>";
        }
        $stmt->close();
    }
    if(isset($_POST['updateCatPhoto'])) {
        $catId = $_POST["catId"];
        $check = getimagesize($_FILES["catImage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'card-'.$catId;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/OnlinePizzaDelivery/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['catImage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('failed');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
}
?>