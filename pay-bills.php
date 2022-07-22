<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: signin.php");
}

?>
<?php
require "user-header.php";
?>

<section class="signup py-4">
<h2 class="text-center pt-5">Pay Bills</h2>
<div class="container pt-2">

<p><span class="text-danger"><span class="text-success"><?php echo $_SESSION['parent_surname']; ?></span>, Sorry for the inconvenieces, the page is under maintenance.</span>.</p>
<a href="user-dashboard.php" class="text-white form-control bg-success text-center">Go Back to Dashboard</a>
</div>

</section>

<?php require "user-footer.php"; ?>