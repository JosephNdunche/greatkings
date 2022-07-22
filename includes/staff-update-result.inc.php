<?php
require_once "database/conn.php";

$error = array();
$grade = "";

if(isset($_GET['unique_id'])){
    $student_id = $_GET['unique_id'];
}

if(isset($_POST['result-btn'])){
    
    $teacher_id = $_SESSION['staff'];

 
    $section = trim($_POST['section']);
    $section = stripslashes($section);
    $section = htmlspecialchars($section);

    $student_id = $_POST['student_id'];

$term = trim($_POST['term']);
$term = stripslashes($term);
$term = htmlspecialchars($term);

$course = trim($_POST['course']);
$course = stripslashes($course);
$course = htmlspecialchars($course);

$test_score = trim($_POST['test_score']);
$test_score = stripslashes($test_score);
$test_score = htmlspecialchars($test_score);

$exam_score = trim($_POST['exam_score']);
$exam_score = stripslashes($exam_score);
$exam_score = htmlspecialchars($exam_score);

    if(empty($section)){
        $error['section'] = "This field cannot be empty";
    }
    if(empty($term)){
        $error['term'] = "This field cannot be empty";
    }
    if(empty($course)){
        $error['course'] = "This field cannot be empty";
    }
    if(empty($test_score)){
        $error['test_score'] = "This field cannot be empty";
    }
    if(empty($exam_score)){
        $error['exam_score'] = "This field cannot be empty";
    }
    

    if(count($error) === 0){
        $total_score = $test_score + $exam_score ;

if($total_score >= 70){
    $grade = "A";
} elseif ($total_score >= 60 && $total_score < 70) {
    $grade = "B";
} elseif ($total_score >= 50 && $total_score < 60) {
    $grade = "C";
} elseif ($total_score >= 45 && $total_score < 50) {
    $grade = "D";
} elseif ($total_score >= 40 && $total_score < 45) {
    $grade = "E";
} elseif ($total_score < 40) {
    $grade = "F";
}
$approved = "0";

$student_course = $_SESSION['student_course'];
$student_session = $_SESSION['student_session'];
$student_term = $_SESSION['student_term'];
        $sql = "UPDATE result SET teacher_id=?, student_id=?, course=?, session=?, term=?, test_score=?, exam_score=?, total_score=?, grade=?, date=NOW(), approved=? WHERE student_id=? AND course=? AND session=? AND term=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('ssssssssssssss', $teacher_id, $student_id, $course, $section, $term, $test_score, $exam_score, $total_score, $grade, $approved, $student_id, $student_course, $student_session, $student_term);
        if($stmt->execute()){
            $_SESSION['student_id'] = $student_id;
            $_SESSION['course'] = $course;
            header("location: staff-success.php");
            exit();
        } else{
            "error";
        }
        }
    } 
