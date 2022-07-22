<?php 
session_start(); 

if(isset($_SESSION['user'])){
    header("location: user-dashboard.php");
}

require "includes/signin.inc.php";
?>
<?php
require "header.php";
?>
<section class="signup py-4">
<h2 class="text-center">Parent Login</h2>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

  <div class="mb-3 mt-3">
    <label for="student_id" class="form-label">Student Id:</label>
    <input type="text" class="form-control" id="student_id" placeholder="Enter Student Id" name="student_id" value="<?php if(isset($student_id)){
        echo $student_id;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['student_id'])){
  echo $error['student_id'];
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

if(isset($error['signin'])){
  echo $error['signin'];
}
?>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="login-btn">Login</button>
</form>
<p class="pt-2"><a href="signup.php">No account yet? </a> <a href="forgotten-user-password.php" class="text-danger px-3">Forgotten Password?</a></p>

</div>
</section>

<?php require "footer.php"; ?>