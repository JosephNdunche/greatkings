<?php
session_start();
if(!isset($_SESSION['staff'])){
    header("location: staff-signin.php");
}

?>

<?php require "staff-header.php"; ?>

<section class="signup py-4">
<h2 class="text-center pb-3">Upload Result</h2>
<div class="container">
    <table class="table table-responsive">
        <tr>
            <th>Student Name</th>
            <th>action</th>
        </tr>
<?php
require_once "database/conn.php";
$class = "jss1";
$sql = "SELECT * FROM users WHERE class = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $class);
$stmt->execute();
$result = $stmt->get_result();
while($rows = $result->fetch_assoc()){
    echo
    '<tr>
            <td>'. $rows['student_names'] .'</td>
            <td><a href="upload.php?unique_id='.$rows['unique_id'].'"> upload</a></td>
        </tr>';
}

?>
</table>
<?php require "user-footer.php"; ?>

