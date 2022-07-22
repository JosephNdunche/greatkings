<?php
session_start();

if(!isset($_SESSION['staff'])){
    header("location: staff-signin.php");
}

require_once "staff-header.php";
?>

<section class="signup py-4">
<h2 class="text-center pb-3">Upload Result</h2>
<div class="container">
    <table class="table table-responsive">
        <tr>
            <th>Student Name</th>
            <th>action</th>
        </tr>
        <?php
require "database/conn.php";
$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
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
</div>
</section>

<?php require_once "user-footer.php";   ?>