<?php

include "database/conn.php";

$error = array();

$student_id = $_SESSION['user'];

if(isset($_POST['payment-btn'])){
    if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 1000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                $verified = "0";
                $sql = "INSERT INTO payment(parent_id, upload, verified, date) VALUES(?,?,?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $student_id, $fileNameNew, $verified);
                if($stmt->execute()){  
            header("location: payment-upload.php");
                }else{
                    $error['file'] = "An error occurred, try again";
                }
            } else{
                $error['file'] = "Not moved";
            }
        } else{
            $error['file'] = "Your file is too long";
        }}
        else{
            $error['file'] = "An error occured";
        }  }
        else{
            $error['file'] = "you cannot upload files of this file";
        }
    

    }    
    }
