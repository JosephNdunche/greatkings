<?php
require_once "database/conn.php";

$error = array();

if(isset($_GET['unique_id'])){
    $student_id = $_GET['unique_id'];
    
    $teacher_id = $_SESSION['staff'];

        $sql = "SELECT * FROM users WHERE unique_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $student_id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $rows = $result->fetch_assoc();
        } else{
            "error";
        }
    }