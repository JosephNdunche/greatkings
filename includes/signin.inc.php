<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['login-btn'])){
    
    $student_id = trim($_POST['student_id']);
    $student_id = stripslashes($student_id);
    $student_id = htmlspecialchars($student_id);

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    if(empty($student_id)){
        $error['student_id'] = "This field cannot be empty";
    }

    if(empty($password)){
        $error['password'] = "This field cannot be empty";
    }

    if(count($error) === 0){
        $sql = "SELECT * FROM users WHERE unique_id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $student_id);
        $stmt -> execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if(password_verify(@$password, @$user['password'])){
            $_SESSION['user'] = $user['unique_id'];
            $_SESSION['parent_surname'] = $user['parent_surname'];
            $_SESSION['parent_other_names'] = $user['parent_other_names'];
            $_SESSION['student_names'] = $user['student_names'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['telephone'] = $user['telephone'];
            $_SESSION['class'] = $user['class'];
            $_SESSION['image'] = $user['parent_image'];
            header("location: user-dashboard.php");
        } else{
            $error['signin'] = "This credentials does not exist";
        }
    }

    
}