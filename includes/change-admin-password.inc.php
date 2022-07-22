<?php
require_once "database/conn.php";

$error = array();
$admin_id = $_SESSION['admin'];

if(isset($_POST['password-btn'])){

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    $newpassword = trim($_POST['newpassword']);
    $newpassword = stripslashes($newpassword);
    $newpassword = htmlspecialchars($newpassword);

    $renewpassword = trim($_POST['renewpassword']);
    $renewpassword = stripslashes($renewpassword);
    $renewpassword = htmlspecialchars($renewpassword);

    $uppercase = preg_match("@[A-Z]@", $newpassword);
    $lowercase = preg_match("@[a-z]@", $newpassword);
    $number = preg_match("@[0-9]@", $newpassword);
    $specialchars = preg_match("@[^\w]@", $newpassword);

        $sql = "SELECT * FROM admin WHERE unique_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if(!password_verify($password, $row['password'])){
            $error['password'] = "current password does not match with our database";
        }

    
    if(empty($newpassword)){
        $error['newpassword'] = "This field cannot be empty";
    } elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($newpassword) < 8){
        $error['newpassword'] = "Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.";
    }

    if($newpassword !== $renewpassword){
        $error['renewpassword'] = "Password does not match";
    }

    if(count($error) === 0){
        $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $pwd_sql = "UPDATE admin SET password=? WHERE unique_id=?";
        $pwd_stmt = $conn->prepare($pwd_sql);
        $pwd_stmt->bind_param('ss', $newpassword, $admin_id);
        if($pwd_stmt->execute()){
            echo "<script>alert('Your password has been updated');</script>";
            header("location: admin-dashboard.php");
            exit();
        } else{
            "error";
        }
    }
    
}