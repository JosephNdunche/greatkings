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

$first_term_score = trim($_POST['first_term_score']);
$first_term_score = stripslashes($first_term_score);
$first_term_score = htmlspecialchars($first_term_score);

$second_term_score = trim($_POST['second_term_score']);
$second_term_score = stripslashes($second_term_score);
$second_term_score = htmlspecialchars($second_term_score);

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
    if(empty($first_term_score)){
        $error['first_term_score'] = "This field cannot be empty";
    }
    if(empty($second_term_score)){
        $error['second_term_score'] = "This field cannot be empty";
    }
    if(empty($test_score)){
        $error['test_score'] = "This field cannot be empty";
    }
    if(empty($exam_score)){
        $error['exam_score'] = "This field cannot be empty";
    }

    $check_query = "SELECT * FROM result WHERE student_id = ? AND course=? AND session=? AND term=?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param('ssss', $student_id, $course, $section, $term);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    if($check_result->num_rows > 0){
        $rows = $check_result->fetch_assoc();
        $_SESSION['student_id'] = $rows['student_id'];
        $_SESSION['student_session'] = $section;
        $_SESSION['student_course'] = $course;
        $_SESSION['student_term'] = $term;
        $error['check'] = 'you have uploaded this users '.$course.' course for '.$term.' and '.$section.' session';
    }

    if(count($error) === 0){
        $total_score = $test_score + $exam_score ;
        $approved = "0";
        $cummulative = $first_term_score + $second_term_score + $total_score;
        $percentage = $cummulative / 3;

if($cummulative >= 70){
    $grade = "A";
} elseif ($cummulative >= 60 && $cummulative < 70) {
    $grade = "B";
} elseif ($cummulative >= 50 && $cummulative < 60) {
    $grade = "C";
} elseif ($cummulative >= 45 && $cummulative < 50) {
    $grade = "D";
} elseif ($cummulative >= 40 && $cummulative < 45) {
    $grade = "E";
} elseif ($cummulative < 40) {
    $grade = "F";
}



        $sql = "INSERT INTO result(teacher_id, student_id, course, session, term, first_term_score, second_term_score, test_score, exam_score, total_score, cummulative, percentage, grade, date, approved) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('ssssssssssssss', $teacher_id, $student_id, $course,  $section, $term, $first_term_score, $second_term_score, $test_score, $exam_score, $total_score, $cummulative, $percentage, $grade, $approved);
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
