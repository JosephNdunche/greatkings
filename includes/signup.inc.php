<?php
require_once "database/conn.php";
$error = array();
$unique_id = "";

if(isset($_POST['submit-btn'])){
    
    $parent_surname = trim($_POST['parent_surname']);
    $parent_surname = stripslashes($parent_surname);
    $parent_surname = htmlspecialchars($parent_surname);

    $parent_other_names = trim($_POST['parent_other_names']);
    $parent_other_names = stripslashes($parent_other_names);
    $parent_other_names = htmlspecialchars($parent_other_names);

    $student_names = trim($_POST['student_names']);
    $student_names = stripslashes($student_names);
    $student_names = htmlspecialchars($student_names);

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

    if(empty($parent_surname)){
        $error['parent_surname'] = "This field cannot be empty";
    } 

    if(empty($parent_other_names)){
        $error['parent_other_names'] = "This field cannot be empty";
    } 

    if(empty($student_names)){
        $error['student_names'] = "This field cannot be empty";
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
        $unique_id = 'greatkings/'. date('Y'). '/' . bin2hex(random_bytes(2));
        $sql = "INSERT INTO users (unique_id, parent_surname, parent_other_names, student_names, email, telephone, class, password) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssss', $unique_id, $parent_surname, $parent_other_names, $student_names, $email, $telephone, $class, $password);
        if($stmt->execute()){
            $_SESSION['user'] = $unique_id;
            $_SESSION['parent_surname'] = $parent_surname;
            $_SESSION['parent_other_names'] = $parent_other_names;
            $_SESSION['student_names'] = $student_names;
            $_SESSION['email'] = $email;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['class'] = $class;
            header("location: user-profile-image.php");
            exit();
        } else{
            $error['signup'] = "An error occured, try again";
        }
    }
    
}