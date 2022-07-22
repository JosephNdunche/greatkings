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

<?php
require "database/conn.php";
$sql = "SELECT * FROM account";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}
?>
<section class="signup py-4">
<h2 class="text-center pt-5">Pay Bills</h2>
<div class="container pt-2">

<p><span class="text-danger"><span class="text-success"><?php echo $_SESSION['parent_surname']; ?></span>, the account details is down below, make payment and make a screen shot of the payment and upload below.</span>.</p>

<h3>Account Details</h3>
<p>Account Name: <span class="text-success"><?php echo $row['account_name'];  ?></span> <br />
Account Number: <span class="text-success"><?php echo $row['account_number'];  ?></span> <br />
Account Bank: <span class="text-success"><?php echo $row['account_bank'];  ?></span> <br />

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
    <label for="file" class="text-success">upload screenshot of Payment</label>
    <input type="file" name="file" id="file" class="form-control">
    <div class="text-danger">
    <?php
if(isset($error['file'])){
  echo $error['file'];
}
?>
  </div>
    <button name="payment-btn" type="submit" class="bg-success text-white mt-2 form-control">Upload Here</button>
</form>
</p>

</section>

<?php require "user-footer.php"; ?>