<?php 

session_start();
 

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

require "includes/admin-manage-account.inc.php";
require "admin-header.php";
?>

<section class="py-5">
<h2 class="text-center my-5">Manage Account</h2>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<p class="text-success">put in your account details for parents to make payment.</p>

  <div class="mb-3 mt-3">
    <input type="text" class="form-control" id="account_name" placeholder="Enter Account Name" name="account_name" value="<?php if(isset($account_name)){
        echo $account_name;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['account_name'])){
  echo $error['account_name'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <input type="text" class="form-control" id="account_number" placeholder="Enter Account Number" name="account_number" value="<?php if(isset($account_number)){
        echo $account_number;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['account_number'])){
  echo $error['account_number'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <input type="text" class="form-control" id="account_bank" placeholder="Enter account Bank" name="account_bank" value="<?php if(isset($account_bank)){
        echo $account_bank;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['account_bank'])){
  echo $error['account_bank'];
}
?>
    </div>
  </div>

  
  <button type="submit" class="btn btn-primary form-control bg-success" name="manage-account">Manage Account</button>
</form>
</div>
</section>


<?php require "user-footer.php"; ?>