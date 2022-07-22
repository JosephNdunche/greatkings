<?php

session_start();

if(!isset($_SESSION['admin'])){
    header('admin-signin.php');
}

require "admin-header.php"
?>


<section class="signup py-4">
<h2 class="text-center pb-3">Success</h2>
<div class="container">
    <p>You have successfully Uploaded your account details.</p>
    <a href="admin-dashboard.php" class="bg-success text-white form-control text-center">Continue</a>
</div>
</section>  

<?php require "user-footer.php"  ?>