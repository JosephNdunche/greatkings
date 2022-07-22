<?php
session_start();

if(!isset($_SESSION['staff'])){
    header("location: staff-signin.php");
}

?>
<?php
require "staff-header.php";
require "database/conn.php";

$student_id = $_SESSION['student_id'];
$course = $_SESSION['course'];
$sql = "SELECT * FROM users WHERE unique_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<section class="signup py-4">
<h2 class="text-center pb-3">Success</h2>
<div class="container">
    <p>You have successfully uploaded <span class="text-success"><?php echo $row['student_names']; ?></span> <span class="text-danger"><?php echo $course; ?></span> result</p>
    <a href="staff-checking-result.php" class="bg-success text-white form-control text-center">Continue</a>
</div>
</section>   

<?php require "user-footer.php"; ?>