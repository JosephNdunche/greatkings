<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['manage-account'])){

    $account_name = trim($_POST['account_name']);
    $account_name = stripslashes($account_name);
    $account_name = htmlspecialchars($account_name);

    $account_number = trim($_POST['account_number']);
    $account_number = stripslashes($account_number);
    $account_number = htmlspecialchars($account_number);

    $account_bank = trim($_POST['account_bank']);
    $account_bank = stripslashes($account_bank);
    $account_bank = htmlspecialchars($account_bank);


    if(empty($account_name)){
        $error['account_name'] = "This field cannot be empty";
    } 

    if(empty($account_number)){
        $error['account_number'] = "This field cannot be empty";
    } 

    if(empty($account_bank)){
        $error['account_bank'] = "This field cannot be empty";
    } 

    if(count($error) === 0){
        $sql = "UPDATE account SET account_name=?, account_number=?, account_bank=?, date=NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $account_name, $account_number, $account_bank);
        if($stmt->execute()){
            header('location: successful-account.php');
            exit();
        } else{
            "error";
        }
    }
    
}