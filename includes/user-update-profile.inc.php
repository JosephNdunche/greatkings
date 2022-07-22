<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['user-update-profile'])){
    
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

    $state_of_origin = trim($_POST['state_of_origin']);
    $state_of_origin = stripslashes($state_of_origin);
    $state_of_origin = htmlspecialchars($state_of_origin);

    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = stripslashes($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    $address = trim($_POST['address']);
    $address = stripslashes($address);
    $address = htmlspecialchars($address);

    $user_id = $_SESSION['user'];

    if(empty($parent_surname)){
        $error['parent_surname'] = "This field cannot be empty";
    } 

    if(empty($parent_other_names)){
        $error['parent_other_names'] = "This field cannot be empty";
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

    if(empty($state_of_origin)){
        $error['state_of_origin'] = "This field cannot be empty";
    }

    if(empty($date_of_birth)){
        $error['date_of_birth'] = "This field cannot be empty";
    }

    if(empty($address)){
        $error['address'] = "This field cannot be empty";
    }
    

    if(count($error) === 0){

        $sql = "UPDATE users SET unique_id=?, parent_surname=?, student_names=?, parent_other_names=?, email=?, telephone=?, class=?, state_of_origin=?, date_of_birth=?, home_address=?, updated=NOW() WHERE unique_id=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssssssss', $user_id, $parent_surname, $parent_other_names, $student_names, $email, $telephone, $class, $state_of_origin, $date_of_birth, $address, $user_id);
        if($stmt->execute()){
            $_SESSION['user'] = $user_id;
            $_SESSION['parent_surname'] = $parent_surname;
            $_SESSION['parent_other_names'] = $parent_other_names;
            $_SESSION['student_names'] = $student_names;
            $_SESSION['email'] = $email;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['class'] = $class;
            $_SESSION['state_of_origin'] = $state_of_origin;
            $_SESSION['date_of_birth'] = $date_of_birth;
            $_SESSION['address'] = $address;
            header("location: users-profile.php");
            exit();
        } else{
            "error";
        }
    }
    
}