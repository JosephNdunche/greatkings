<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: signin.php");
}

?>
<?php
require "includes/payment.inc.php";
require "user-header.php";
?>

<section class="signup py-4">
<h2 class="text-center pt-5">Payment Review</h2>
<div class="container pt-2">

<p><span><span class="text-success"><?php echo $_SESSION['parent_surname']; ?></span>, Your payment is under review, check back later.</span>.</p>
<a href="user-dashboard.php" class="btn btn-success form-control">Go to Dashboard</a>
</section>

<?php require "user-footer.php"; ?>