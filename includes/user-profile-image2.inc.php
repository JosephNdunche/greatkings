<?php

include "database/conn.php";

$error = array();

$student_id = $_SESSION['user'];

if(isset($_POST['image-btn'])){
    if(isset($_FILES['parent_image'])){
    $file = $_FILES['parent_image'];
    $fileName = $_FILES['parent_image']['name']; 
    $fileTmp = $_FILES['parent_image']['tmp_name'];
    $fileSize = $_FILES['parent_image']['size'];
    $fileError = $_FILES['parent_image']['error'];
    $fileType = $_FILES['parent_image']['type'];

    $fileExt = explode('.', $_FILES['parent_image']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['parent_image']['error'] === 0){
        if($_FILES['parent_image']['size'] < 1000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['parent_image']['tmp_name'], $fileDestination)){
            $sql = "UPDATE users SET student_image = '$fileNameNew' WHERE unique_id='$student_id'";
            $result = mysqli_query($conn, $sql);
            $_SESSION['child_image'] = $fileNameNew;
            header("location: verify-email.php");
            } else{
                $error['parent_image'] = "Not moved";
            }
        } else{
            $error['parent_image'] = "Your file is too long";
        }}
        else{
            $error['parent_image'] = "An error occured";
        }  }
        else{
            $error['parent_image'] = "you cannot upload files of this file";
        }
    

    }    
    }
