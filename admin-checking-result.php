<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

//require "includes/result-checker.inc.php";
$total_score = 0;
$percentage = 0;
?>
<?php
require "admin-header.php";
?>
<?php
 require "database/conn.php";
 $student_id = $_SESSION['student_id'];
 $sql = "SELECT * FROM users where unique_id=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('s', $student_id);
 $stmt->execute();
 $result = $stmt->get_result();
 $fetch = $result->fetch_assoc();
?>

<section class="py-4 mb-5">
<h1 class="text-center pt-5 text-success">Great Kings Academy</h1>
<div class="container pt-1 text-right">
    <p style="text-align: right;">1 Banire Street, Banire B/stop, Egbeda, Lagos. <br />
    COMPREHENSIVE ANALYSIS OF ASSESSMENT IN THE THREE DOMAINS COGNITIVE PHYSCO-MOTOR AND AFFECTIVE
</p>
<p style="text-align: right;">Term: <span class="text-success"><?php echo $_SESSION['term'] ?></span> <br />Session: <span class="text-success"><?php echo $_SESSION['session'] ?></span></p>

<p style="text-align: left;">Name: <span class="text-success"><?php echo $fetch['student_names']; ?></span><br />
Class: <span class="text-success"><?php echo $_SESSION['class']; ?></span><br />
</p>

<table class="table table-responsive">
    <tr>
    <th>Course</th>
        <th>IST Term Scores(100)</th>
        <th>2ND Term Scores(100)</th>
        <th>C.A(40)</th>
        <th>Exam(60)</th>
        <th>Total(100)</th>
        <th>Cummulative</th>
        <th>Percentage</th>
        <th>Grade</th>
        <th><i class="bi bi-columns-gap"></i></th>
    </tr>
    <?php
    $admin_id = $_SESSION['admin'];
    $term = $_SESSION['term'];
    $session = $_SESSION['session'];

    $sql = "SELECT * FROM result where student_id=? AND term=? AND session=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $session);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        ?>
        <?php
    echo '
    <tr>
    <td>'. $row['course'] .'</td>
    <td>'. $row['first_term_score'] .'</td>
    <td>'. $row['second_term_score'] .'</td>
    <td>'. $row['test_score'] .'</td>
    <td>'. $row['exam_score'] .'</td>
    <td>'. $row['total_score'] .'</td>
    <td>'. $row['cummulative'] .'</td>
    <td>'. floor($row['percentage']) .'</td>
    <td>'. $row['grade'] .'</td>
    <td><a href="admin-update-result2.php?unique_id='.$row['student_id'].'&student_course='.$row['course'].'&student_session='.$row['session'].'&student_term='.$row['term'].'&student_first_term_score='.$row['first_term_score'].'&student_second_term_score='.$row['second_term_score'].'"><i class="bi bi-pencil-square"></i></a><a href="admin-update-result2.php?unique_id='.$row['student_id'].'&student_course='.$row['course'].'&student_session='.$row['session'].'&student_term='.$row['term'].'"><i class="bi bi-archive text-danger"></i></a></td>
    </tr>
    ';
    }
    $stmt->close();

    ?>
</table>
<?php

$sql = "SELECT * FROM result where student_id=? AND term=? AND session=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $student_id, $term, $session);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;;
while($row = $result->fetch_assoc()){
    ?>
    <?php
    $total_score = $row['total_score'] + $total_score; 
    $percentage = $row['percentage'] + $percentage;
}

$stmt->close();

$count_class = $_SESSION['class'];
$sql = "SELECT * FROM users where class=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $count_class);
$stmt->execute();
$result = $stmt->get_result();
$no_of_class = $result->num_rows;

?>
<div class="container">
<h3 class="pt-2">Result Details</h3>
<p>Total Score: <span class="text-success"><?php echo $total_score;  ?></span> <br />
Number in Class: <span class="text-success"><?php echo $no_of_class;  ?></span> <br />
<?php $count_percentage = $percentage / $count; ?>
Percentage: <span class="text-success"><?php echo floor($count_percentage);  ?></span> <br />
Class Teacher's Comment: <span class="text-success">A very Good student</span>
</p>

<?php
if(isset($_POST['approve-result'])){
    $sql = "UPDATE result SET approved='1' where student_id=? AND term=? AND session=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $session);
    if($stmt->execute()){
        echo "<script>alert('The result has been approved');</script>";
    }
    
    
}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<button  class="btn btn-success text-white" name="approve-result">Approve Result</button>
</form>
<?php
/*if($ave_score >= 70){
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
}*/
?>

</div>
</section>

<?php require "user-footer.php";
