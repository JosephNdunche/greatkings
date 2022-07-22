<?php
session_start();
if(!isset($_SESSION['staff'])){
    header("location: staff-signin.php");
}

?>
<?php
require "staff-header.php"; 
?>

<section class="py-4">
    <h2 class="text-center pt-5">Manage Class</h2>
<div class="container pt-2">

    <?php require "includes/staff-manage-student.inc.php"; ?>
    <div class="text-danger">
    <?php
if(isset($error['user'])){
    echo $error['user'];
  }
?>
    </div>


</div>
</section>

<?php 
require "user-footer.php";  ?>