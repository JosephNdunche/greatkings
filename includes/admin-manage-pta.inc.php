<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['manage-pta'])){

    $user = trim($_POST['user']);
    $user = stripslashes($user);
    $user = htmlspecialchars($user);

    $topic = trim($_POST['topic']);
    $topic = stripslashes($topic);
    $topic = htmlspecialchars($topic);

    $comment = trim($_POST['comment']);
    $comment = stripslashes($comment);
    $comment = htmlspecialchars($comment);


    if(empty($user)){
        $error['user'] = "This field cannot be empty";
    } 

    if(empty($topic)){
        $error['topic'] = "This field cannot be empty";
    } 

    if(empty($comment)){
        $error['comment'] = "This field cannot be empty";
    } 

    if(count($error) === 0){
        $sql = "INSERT INTO pta (user, topic, comment, date) VALUES(?,?,?,NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $user, $topic, $comment);
        if($stmt->execute()){
            $_SESSION['user_type'] = $user;
            header('location: successful-pta.php');
            exit();
        } else{
            "error";
        }
    }
    
}