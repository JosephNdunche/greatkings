<?php

session_start();

if(!isset($_SESSION['user'])){
    header("location: signin.php");
}
require_once "database/conn.php";
require_once "user-header.php";

?>
 <?php
   $class = $_SESSION['class'];
   if(isset($_GET['unique_id'])){
   $assignment_id = trim($_GET['unique_id']);
   $assignment_id = stripslashes($assignment_id);
   $assignment_id = htmlspecialchars($assignment_id);
   }
   $sql = "SELECT * FROM assignment WHERE class=? AND assignment_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param('si', $class, $assignment_id);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $course = $row['course'];
    $staff_id =  $row['teacher_id'];
    $topic =  $row['topic'];
    $assignment =  $row['assignment'];
    $pdf =  $row['pdf'];
    //$date = $row['date'];
   }
        ?>

<section class="py-4">
    <!--<h2 class="text-center pt-5"><?php echo $course; ?></h2>
<div class="container pt-2 text-center">
    <p class="text-center">Topic: <?php echo $topic; ?></p>
    <p>Teacher: <?php echo $staff_id; ?></p>
    <p>Assignment: <?php echo $assignment; ?></p>
    <p>Pdf: <?php echo $pdf; ?></p>
</div>
-->
<div class="row pt-5">
     <!-- Left side columns -->
     <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title text-center"></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    </div>

                    <div class="ps-1">
                      <h3>Hi, <span class="text-success"><?php echo $_SESSION['parent_surname']; ?></span></h3>
                      <span class="text-muted small pt-2 ps-1">You have been given an assignment on <span class="text-success"><?php echo $course; ?></span> on a topic which says <span class="text-success"><?php echo $topic; ?></span></span>
                      <p class="pt-3"><span class="text-danger">The assignment below to be submitted <span>on Tuesday</span>:</span><br /><?php echo $assignment; ?></p>
                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <a href="download-assignment.php?path=uploads/<?php echo $pdf ?>" class="btn btn-success">Download Assignment(PDF)</a>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
</div>

</section>


<?php require_once "user-footer.php"; ?>

