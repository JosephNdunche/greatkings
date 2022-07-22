<?php

session_start();

if(!isset($_SESSION['user'])){
    header("location: signin.php");
}
require_once "database/conn.php";
require_once "user-header.php";

?>
<section class="py-4">
    <h2 class="text-center pt-5">Student Assignment</h2>
<div class="container pt-2">

<table class="table table-responsive"> 
    <tr>
        <th>Course</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

<?php
   $class = $_SESSION['class'];
   $sql = "SELECT * FROM assignment WHERE class=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param('s', $class);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>

    <?php
    echo '
       <tr>
       <td>'.$row['course'].'</td>
       <td>'.$row['date'].'</td>
       <td><a href="see-assignment.php?unique_id='.$row['assignment_id'].'" style="font-size: 1.3rem;"><i class="bi bi-box-arrow-in-right"></i></a></td>
       </tr>
    ';
    }
    echo '</table>';
   } else{
   ?>
    
<p class="text-danger text-center">No Assignment, check later.</p>

<?php } ?>

</div>

</section>


<?php require_once "user-footer.php"; ?>

