<?php
require "database/conn.php";

$error = array();

$staff_id = $_SESSION['staff'];

if(isset($_POST['assignment-btn'])){

    $course = trim($_POST['course']);
    $course = stripslashes($course);
    $course = htmlspecialchars($course);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $topic = trim($_POST['topic']);
    $topic = stripslashes($topic);
    $topic = htmlspecialchars($topic);

    $assignment = trim($_POST['assignment']);
    $assignment = stripslashes($assignment);
    $assignment = htmlspecialchars($assignment);

    if(empty($course)){
        $error['course'] = "This field cannot be empty";
    }   

    if(empty($class)){
        $error['class'] = "This field cannot be empty";
    } 

    if(empty($topic)){
        $error['topic'] = "This field cannot be empty";
    } 

    if(empty($assignment)){
        $error['assignment'] = "This field cannot be empty";
    } 
    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name']; 
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
    
        $fileExt = explode('.', $_FILES['file']['name']);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'png','pdf');
        if(in_array($fileActualExt, $allowed)){
            if($_FILES['file']['error'] === 0){
            if($_FILES['file']['size'] < 2000000){
                $fileNameNew = time() . '.' . $fileActualExt;
                $fileDestination = 'uploads/'. $fileNameNew;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                $_SESSION['file'] = $fileNameNew;
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

   
    if(count($error) === 0){
        $sql = "INSERT INTO assignment (teacher_id, course, class, topic, pdf, assignment, updated) VALUES(?,?,?,?,?,?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss', $staff_id, $course, $class, $topic, $fileNameNew, $assignment);
        if($stmt->execute()){
            $_SESSION['assignment_course'] = $course;
            $_SESSION['assignment_class'] = $class;
            $_SESSION['assignment_topic'] = $topic;
            $_SESSION['assignment'] = $assignment;
            header("location: staff-dashboard.php");
            exit();
        } else{
            "error";
        }
    }
    
}