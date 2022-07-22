<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

?>
<?php
require "admin-header.php"; 
?>

<section class="py-4">
    <h2 class="text-center pt-5">Manage Students</h2>
<div class="container pt-2">

    <?php require "includes/admin-manage-result.inc.php"; ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <select name="class" id="" class="form-control">
        <option value="">Select Class</option>
        <option value="jss1">JSS1</option>
        <option value="jss2 A">JSS2 A</option>
        <option value="jss2 B">JSS2 B</option>
        <option value="jss3">JSS3</option>
        <option value="ss1">SS1</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['user'])){
    echo $error['user'];
  }
?>
    </div>
    <button type="submit" class="form-control btn btn-success mt-2" name="manage-student-btn">Continue</button>
</form>


</div>
</section>

<?php 
require "user-footer.php";  ?>