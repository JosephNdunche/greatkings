<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: signin.php");
}

require "includes/result-checker.inc.php";
?>
<?php
require "user-header.php";
?>

<section class="signup py-4">
<h2 class="text-center pt-5">Result Checker</h2>
<div class="container pt-2">

<?php
  require "database/conn.php";
  $student_id = $_SESSION['user'];

  $sql = "SELECT * FROM scratch_card WHERE student_id = ? AND verified = '1'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $student_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $num_of_rows = $result->num_rows;
  if($num_of_rows > 0){
    $fetch = $result->fetch_assoc();

?>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<p>Your scratch card pin is <span class="text-success"><?php echo $fetch['scratch_card']; ?></span>.<br />
we have helped you to insert it, you can now check your result.
</p>
  <div class="mb-3 mt-3">
    <select name="term" id="term" class="form-control">
        <option value="">select term</option>
        <option value="first term">first term</option>
        <option value="second term">second term</option>
        <option value="third term">third term</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['term'])){
  echo $error['term'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <select name="section" id="section" class="form-control">
        <option value="">select section</option>
        <option value="2017/2018">2017/2018</option>
        <option value="2018/2019">2018/2019</option>
        <option value="2019/2020">2019/2020</option>
        <option value="2020/2021">2020/2021</option>
        <option value="2021/2022">2021/2022</option>
        <option value="2022/2023">2022/2023</option>
        <option value="2023/2024">2023/2024</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['section'])){
  echo $error['section'];
}
?>
    </div>
    <div class="text-danger">
  <?php
if(isset($error['result'])){
  echo $error['result'];
}
  ?>
</div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="result-btn">Check Result</button>
</form>
<?php } else{ ?>
  <?php 
  $sql = "SELECT * FROM payment WHERE parent_id = ? AND verified = '0'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $student_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $num_of_rows = $result->num_rows;
  if($num_of_rows > 0){
    ?>

<p><span><span class="text-success"><?php echo $_SESSION['parent_surname']; ?></span>, Your payment is under review, check back later.</span>.</p>
<a href="user-dashboard.php" class="btn btn-success form-control">Go to Dashboard</a>
</section>

    <?php }else{ ?>
<p>For you to check <span class="text-success"><?php echo $_SESSION['student_names']; ?></span> result with a student id of <span class="text-success"><?php echo $_SESSION['user']; ?></span> you have to buy a scratch card</p>
<a href="payment.php" class="text-white form-control bg-success text-center">Buy Scratch Card here</a>
</div>
<?php }} ?>
</div>

</section>


<?php require "user-footer.php"; ?>