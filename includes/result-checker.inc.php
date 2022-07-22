<?php
require_once "database/conn.php";

$error = array();

if(isset($_POST['result-btn'])){
    
    $term = trim($_POST['term']);
    $term = stripslashes($term);
    $term = htmlspecialchars($term);

    $section = trim($_POST['section']);
    $section = stripslashes($section);
    $section = htmlspecialchars($section);

    if(empty($term)){
        $error['term'] = "This field cannot be empty";
    }

    $student_id = $_SESSION['user'];
    $sql = "SELECT * FROM result WHERE student_id=? AND term=? AND session=? AND approved='1'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $section);
    $stmt->execute();
    $result = $stmt->get_result();
    $num_of_rows = $result->num_rows;

    if(empty($section)){
        $error['section'] = "this field cannot be empty";
    }
    elseif($num_of_rows === 0){
        $error['result'] = "No result yet, check later";
    }

    if(count($error) === 0){
        $_SESSION['term'] = $term;
        $_SESSION['session'] = $section;
        header("location: check-result.php");
    }

}