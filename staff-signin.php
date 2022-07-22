<?php 
session_start(); 

if(isset($_SESSION['staff'])){
    header("location: staff-dashboard.php");
}
require "includes/staff-signin.inc.php";
?>
<?php
require "header.php";
?>
<section class="signup py-4">
<h2 class="text-center">Staff Login</h2>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

  <div class="mb-3 mt-3">
    <label for="staff_id" class="form-label">Staff Id:</label>
    <input type="text" class="form-control" id="staff_id" placeholder="Enter Staff Id" name="staff_id" value="<?php if(isset($staff_id)){
        echo $staff_id;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['staff_id'])){
  echo $error['staff_id'];
}
?>
    </div>
  </div>
  
  <div class="mb-3">
    <label for="pwd" class="form-label">Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    <div class="text-danger">
    <?php
if(isset($error['password'])){
  echo $error['password'];
}
?>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="login-btn">Login</button>
</form>
<p class="pt-2"><a href="staff-signup.php">No account yet? </a> <a href="forgotten-staff-password.php" class="text-danger px-4">Forgotten Password?</a></p>
</div>
</section>

<?php require "footer.php"; ?>