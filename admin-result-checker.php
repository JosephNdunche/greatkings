<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

require "includes/admin-result-checker.inc.php";
?>
<?php
require "admin-header.php";
if(isset($_GET['unique_id'])){
    $student_id = $_GET['unique_id'];
}
?>

<section class="signup py-4">
<h2 class="text-center pt-5">Manage Result</h2>
<div class="container pt-2">

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

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

  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="result-btn">Check Result</button>
</form>

</div>

</section>

<?php require "user-footer.php"; ?>