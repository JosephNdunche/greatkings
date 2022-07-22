<?php 
session_start(); 

if(!isset($_SESSION['user'])){
    header("location: signin.php");
}

require "includes/user-profile-image.inc.php";

?>
<?php
require "header.php";
?>
<section class="signup py-4">
<h2 class="text-center">Upload Image</h2>
<div class="container">
    <p>to verify your account you have to upload a recent profile image of yourself.<br />
    <span class="text-danger">Note: if you dont upload a picture of yourself we will delete this account for maximum security.</span>
</p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
  
  <div class="mb-3 mt-3">
    <label for="parent_image">Upload Parent Picture</label>
    <input type="file" class="form-control" id="parent_image" name="parent_image">
    <div class="text-danger">
    <?php
if(isset($error['parent_image'])){
  echo $error['parent_image'];
}
?>
  </div>

  
  <button type="submit" class="btn btn-primary form-control bg-success mt-3" name="image-btn">Upload Image</button>
</form>

</div>
</section>

<?php require "footer.php"; ?>