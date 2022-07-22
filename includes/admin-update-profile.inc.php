<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['admin-update-profile'])){
    
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

    $state_of_origin = trim($_POST['state_of_origin']);
    $state_of_origin = stripslashes($state_of_origin);
    $state_of_origin = htmlspecialchars($state_of_origin);

    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = stripslashes($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    $address = trim($_POST['address']);
    $address = stripslashes($address);
    $address = htmlspecialchars($address);

    $admin_id = $_SESSION['admin'];

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
        $admin_id = $_SESSION['admin'];
        $sql = "UPDATE admin SET unique_id=?, surname=?, other_names=?, email=?, telephone=?, class=?, state_of_origin=?, date_of_birth=?, home_address=?, updated=NOW() WHERE unique_id=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssss', $admin_id, $surname, $other_names, $email, $telephone, $class, $state_of_origin, $date_of_birth, $address, $admin_id);
        if($stmt->execute()){
            $_SESSION['admin'] = $admin_id;
            $_SESSION['surname'] = $surname;
            $_SESSION['other_names'] = $other_names;
            $_SESSION['email'] = $email;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['class'] = $class;
            $_SESSION['state_of_origin'] = $state_of_origin;
            $_SESSION['date_of_birth'] = $date_of_birth;
            $_SESSION['address'] = $address;
            header("location: admin-profile.php");
            exit();
        } else{
            "error";
        }
    }
    
}