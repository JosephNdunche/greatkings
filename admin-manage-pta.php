<?php 
session_start(); 

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}
require "includes/admin-manage-pta.inc.php";

?>
<?php
require "admin-header.php";

?>
<section class="py-5">
<h2 class="text-center my-5">Manage PTA</h2>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<p class="text-success">You can send a message to your teachers or parents here.</p>
  <div class="mb-3 mt-3">
    <select name="user" id="" class="form-control">
        <option value="">Select User</option>
        <option value="teachers">Teachers</option>
        <option value="parents">Parents</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['user'])){
  echo $error['user'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <input type="text" class="form-control" id="other-names" placeholder="Enter Topic" name="topic" value="<?php if(isset($topic)){
        echo $topic;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['topic'])){
  echo $error['topic'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <textarea name="comment" id="" cols="30" rows="7" class="form-control">
        You can type your message here....
    </textarea>
    <div class="text-danger">
    <?php
if(isset($error['comment'])){
  echo $error['comment'];
}
?>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="manage-pta">Manage PTA</button>
</form>
</div>
</section>

<?php require "user-footer.php"; ?>