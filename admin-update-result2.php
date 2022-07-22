<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

require "includes/admin-update-result2.inc.php";

?>
<?php
require_once "admin-header.php";
?>

<section class="signup py-4 mb-5">
<h2 class="text-">Update Result</h2>
<div class="container">
  
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

  <div class="mb-3 mt-3">
  <?php
    $student_query = "SELECT * FROM users WHERE unique_id = ?";
    $student_stmt = $conn->prepare($student_query);
    $student_stmt->bind_param('s', $student_id);
    $student_stmt->execute();
    $student_result = $student_stmt->get_result();
    if($student_result->num_rows > 0){
        $student_rows = $student_result->fetch_assoc();
        $student_names = $student_rows['student_names'];
        $student_uid = $student_rows['unique_id'];
        $student_class = $student_rows['class'];
        
    }
    ?>
  <?php 
  echo '
    <p>Student Name: <span class="text-success">'.$student_names.'</span><br />
    Student Uid: <span class="text-success">'.$student_uid.'</span><br />
    Student Class: <span class="text-success">'.$student_class.'</span><br />
    </p>
  ';
  ?>
    <select name="section" id="section" class="form-control">
        <option value="<?php
    if(isset($student_session)){
      echo $student_session;
    }else{
      echo "";
    }
    ?>"><?php
    if(isset($student_session)){
      echo $student_session;
    }else{
      echo "Select Section";
    }
    ?></option>
        <option value="2017/2018">2017/2018</option>
        <option value="2018/2019">2018/2019</option>
        <option value="2019/2020">2019/2020</option>
        <option value="2020/2021">2020/2021</option>
        <option value="2021/2022">2021/2022</option>
        <option value="2022/2023">2022/2023</option>
        <option value="2023/2024">2023/2024</option>
        <option value="2024/2025">2024/2025</option>
        <option value="2025/2026">2025/2026</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['section'])){
  echo $error['section'];
}
?>
    </div>
  </div>
  
  <div class="mb-3">
    <select name="term" id="term" class="form-control">
    <option value="<?php
    if(isset($student_term)){
      echo $student_term;
    }else{
      echo "";
    }
    ?>"><?php
    if(isset($student_term)){
      echo $student_term;
    }else{
      echo "Select Term";
    }
    ?></option>
        <option value="first term">First Term</option>
        <option value="second term">Second Term</option>
        <option value="third term">Third Term</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['term'])){
  echo $error['term'];
}
?>
    </div>
  </div>

  <div class="mb-3">
    <select name="course" id="course" class="form-control">
    <option value="<?php
    if(isset($student_course)){
      echo $student_course;
    }else{
      echo "";
    }
    ?>"><?php
    if(isset($student_course)){
      echo $student_course;
    }else{
      echo "Select Course";
    }
    ?></option>
        <option value="english">English Language</option>
        <option value="lit in english">Lit In English</option>
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

  <div class="mb-3">
    <input type="tel" class="form-control" name="first_term_score" id="first_term_score" value="<?php
    if(isset($student_first_term_score)){
      echo $student_first_term_score;
    }else{
      echo "Enter First Term Score(100%)";
    }
    ?>" name="first_term_score">
    <div class="text-danger">
    <?php
if(isset($error['first_term_score'])){
  echo $error['first_term_score'];
}
?>
    </div>
  </div>

  <div class="mb-3">
    <input type="tel" class="form-control" name="second_term_score" id="second_term_score" value="<?php
    if(isset($student_second_term_score)){
      echo $student_second_term_score;
    }else{
      echo "Enter Second Term Score(100%)";
    }
    ?>">
    <div class="text-danger">
    <?php
if(isset($error['second_term_score'])){
  echo $error['second_term_score'];
}
?>
    </div>
  </div>


  <div class="mb-3">
    <input type="tel" class="form-control" id="test_score" placeholder="Enter Test Score" name="test_score">
    <div class="text-danger">
    <?php
if(isset($error['test_score'])){
  echo $error['test_score'];
}
?>
    </div>
  </div>

  <div class="mb-3">
    <input type="tel" class="form-control" id="exam_score" placeholder="Enter Exam Score" name="exam_score">
    <div class="text-danger">
    <?php
if(isset($error['exam_score'])){
  echo $error['exam_score'];
}
if(isset($error['check'])){
  echo $error['check'];
}
?>
    </div>
  </div>
  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
  <input type="hidden" name="student_course" value="<?php echo $student_course; ?>">
  <input type="hidden" name="student_session" value="<?php echo $student_session; ?>">
  <input type="hidden" name="student_term" value="<?php echo $student_term; ?>">
  <input type="hidden" name="student_first_term_score" value="<?php echo $student_first_term_score; ?>">
  <input type="hidden" name="student_second_term_score" value="<?php echo $student_second_term_score; ?>">
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="result-btn">Upload Result</button>
</form>
</div>
</section>

<?php require_once "user-footer.php";  ?>