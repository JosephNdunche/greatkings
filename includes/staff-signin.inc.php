<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['login-btn'])){
    
    $staff_id = trim($_POST['staff_id']);
    $staff_id = stripslashes($staff_id);
    $staff_id = htmlspecialchars($staff_id);

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    if(empty($staff_id)){
        $error['staff_id'] = "This field cannot be empty";
    }

    if(empty($password)){
        $error['password'] = "This field cannot be empty";
    }

    if(count($error) === 0){
        $sql = "SELECT * FROM staff WHERE unique_id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $staff_id);
        $stmt -> execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();

        if(password_verify(@$password, @$staff['password'])){
            $_SESSION['staff'] = $staff['unique_id'];
            $_SESSION['surname'] = $staff['surname'];
            $_SESSION['other_names'] = $staff['other_names'];
            $_SESSION['email'] = $staff['email'];
            $_SESSION['telephone'] = $staff['telephone'];
            $_SESSION['class'] = $staff['class'];
            $_SESSION['verified'] = $staff['verified'];
            $_SESSION['image'] = $staff['image'];
            header("location: staff-dashboard.php");
            exit();
        } else{
            $error['password'] = "Credentials does not match with the one on our database, try again";
        }
    }

    
}