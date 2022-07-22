<?php
session_start();
if(!isset($_SESSION['staff'])){
    header("location: staff-signin.php");
}

require "includes/upload-assignment.inc.php";
?>
<?php
require "staff-header.php"; 
?>


<section class="py-5">
    <h2 class="text-center pt-5">Upload Assignment</h2>
<div class="container pt-2">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

<div class="mb-3 mt-3">
    <select name="course" id="course" class="form-control">
        <option value="">Select Course</option>
        <option value="english">English</option>
        <option value="lit in eng">Lit In Eng</option>
        <option value="french">French</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['course'])){
  echo $error['course'];
}
?>
    </div>
  </div>

<div class="mb-3 mt-3">
    <select name="class" id="class" class="form-control">
        <option value="">Select Class</option>
        <option value="jss1">JSS1</option>
        <option value="jss2 A">JSS2 A</option>
        <option value="jss2 B">JSS2 B</option>
        <option value="jss3">JSS3</option>
        <option value="ss1">SS1</option>
        <option value="ss2A">SS2 A</option>
        <option value="ss2B">SS2 B</option>
        <option value="ss3A">SS3 A</option>
        <option value="ss3B">SS3 B</option>
    </select>

    <div class="text-danger">
    <?php
if(isset($error['class'])){
  echo $error['class'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <input type="text" name="topic" id="" class="form-control" placeholder="Enter Topic">
    <div class="text-danger">
    <?php
if(isset($error['topic'])){
  echo $error['topic'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <label for="attachment">Send PDF attachment</label>
    <input type="file" name="file" id="attachment" class="form-control">
    <div class="text-danger">
    <?php
if(isset($error['file'])){
  echo $error['file'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <textarea name="assignment" id="" rows="7" class="form-control">
    Type Assignment here.....
    </textarea>
    <div class="text-danger">
    <?php
if(isset($error['assignment'])){
  echo $error['assignment'];
}
?>
    </div>
  </div>

  <button type="submit" class="btn btn-primary form-control bg-success mb-5" name="assignment-btn">Upload Assignment</button>
</form>


</div>
</section>

<?php 
require "user-footer.php";  ?>