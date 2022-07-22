<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['submit-btn'])){

    $surname = trim($_POST['surname']);
    $surname = stripslashes($surname);
    $surname = htmlspecialchars($surname);

    $other_names = trim($_POST['other_names']);
    $other_names = stripslashes($other_names);
    $other_names = htmlspecialchars($other_names);

    $email = trim($_POST['email']);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $telephone = trim($_POST['telephone']);
    $telephone = stripslashes($telephone);
    $telephone = htmlspecialchars($telephone);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    $confirm_password = trim($_POST['confirm_password']);
    $confirm_password = stripslashes($confirm_password);
    $confirm_password = htmlspecialchars($confirm_password);

    $uppercase = preg_match("@[A-Z]@", $password);
    $lowercase = preg_match("@[a-z]@", $password);
    $number = preg_match("@[0-9]@", $password);
    $specialchars = preg_match("@[^\w]@", $password);

    if(empty($surname)){
        $error['surname'] = "This field cannot be empty";
    } 

    if(empty($other_names)){
        $error['other_names'] = "This field cannot be empty";
    } 

    if(empty($email)){
        $error['email'] = "This field cannot be empty";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['email'] = "Invalid email format";
    }

    if(empty($telephone)){
        $error['telephone'] = "This field cannot be empty";
    } elseif(!preg_match("@[0-9]@", $telephone)){
        $error['telephone'] = "Invalid Telephone format";
    }

    if(empty($class)){
        $error['class'] = "This field cannot be empty";
    }
    
    if(empty($password)){
        $error['password'] = "This field cannot be empty";
    } elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8){
        $error['password'] = "Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.";
    }

    if($password !== $confirm_password){
        $error['confirm_password'] = "Password does not match";
    }

    if(count($error) === 0){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $unique_id = 'admin/'. date('Y'). '/' . bin2hex(random_bytes(2));
        $verified = '0';
        $sql = "INSERT INTO admin (unique_id, surname, other_names, email, telephone, class, password, verified) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssss', $unique_id, $surname, $other_names, $email, $telephone, $class, $password, $verified);
        if($stmt->execute()){
            $_SESSION['admin'] = $unique_id;
            $_SESSION['surname'] = $surname;
            $_SESSION['other_names'] = $other_names;
            $_SESSION['email'] = $email;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['class'] = $class;
            $_SESSION['verified'] = $verified;
            header("location: staff-profile-image.php");
            exit();
        } else{
            "error";
        }
    }
    
}