<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: signin.php");
}

require "header.php";
?>
<section class="signup py-4">
    <div class="container">
        <h3 class="text-center pb-3">Your Account has been created</h3>
        <p class="pb-2">Congratulations, your new account has been successfully created! <br /><br />
        You can now take advantage of member priviledges to enhance your experience with us. <br /><br />
        Your unique id is <span class="text-success"><?php echo $_SESSION['user']; ?></span>, keep it really well to access this account. <br /><br /> 
        if you have ANY questions about the operation of this School Management System, please e-mail the Admin or the Principal(<span class="text-success">Mr Odion</span>). <br /><br />
        A confirmation has been sent to the provided e-mail address. if you have not received it within the hour, please contact us.   
    </p>
    <p class="text-center"><a href="user-dashboard.php" class="bg-success text-white rounded form-control">Continue</a></p>
    </div>
</section>
<?php require "footer.php";  ?>
