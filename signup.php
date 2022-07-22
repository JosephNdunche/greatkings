<?php 
session_start(); 

if(isset($_SESSION['user'])){
    header("location: user-dashboard.php");
}
require "includes/signup.inc.php";

?>
<?php
require "header.php";

?>
<section class="signup py-4">
<h2 class="text-center">Parent Signup</h2>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

  <div class="mb-3 mt-3">
    <label for="parent-surname" class="form-label">Parent Surname:</label>
    <input type="text" class="form-control" id="parent-surname" placeholder="Enter Parent Surname" name="parent_surname" value="<?php if(isset($parent_surname)){
        echo $parent_surname;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['parent_surname'])){
  echo $error['parent_surname'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <label for="parent-other-names" class="form-label">Parent Other Names:</label>
    <input type="text" class="form-control" id="parent-other-names" placeholder="Enter Parent Other Names" name="parent_other_names" value="<?php if(isset($parent_other_names)){
        echo $parent_other_names;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['parent_other_names'])){
  echo $error['parent_other_names'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <label for="student-names" class="form-label">Student Full Names:</label>
    <input type="text" class="form-control" id="student-names" placeholder="Enter Student Full Names" name="student_names" value="<?php if(isset($student_names)){
      echo $student_names;
    }  ?>">
    <div class="text-danger">
    <?php
if(isset($error['student_names'])){
  echo $error['student_names'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email Address:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email Address" name="email" value="<?php if(isset($email)){
      echo $email;
    }  ?>">
    <div class="text-danger">
    <?php
if(isset($error['email'])){
  echo $error['email'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <label for="telephone" class="form-label">Telephone:</label>
    <input type="tel" class="form-control" id="telephone" placeholder="Enter Telephone Number" name="telephone" value="<?php if(isset($telephone)){
      echo $telephone;
    }  ?>">
    <div class="text-danger">
    <?php
if(isset($error['telephone'])){
  echo $error['telephone'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <label for="class" class="form-label">Student Class:</label>
    <select name="class" id="class" class="form-control">
        <option value="<?php if(isset($class)){
          echo $class;
        }else{
          echo "Enter Your class";
        } ?>"><?php if(isset($class)){
          echo $class;
        }else{
          echo "Enter Your class";
        } ?></option>
        <option value="jss1">JSS1</option>
        <option value="jss2">JSS2</option>
        <option value="jss3">JSS3</option>
        <option value="ss1">SS1</option>
        <option value="ss2">SS2</option>
        <option value="ss3">SS3</option>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['class'])){
  echo $error['class'];
}
?>
    </div>
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    <div class="text-danger">
    <?php
if(isset($error['password'])){
  echo $error['password'];
}
?>
    </div>
  </div>
  <div class="mb-3">
    <label for="cpwd" class="form-label">Confirm Password:</label>
    <input type="password" class="form-control" id="cpwd" placeholder="Confirm password" name="confirm_password">
    <div class="text-danger">
    <?php
if(isset($error['confirm_password'])){
  echo $error['confirm_password'];
}
if(isset($error['signup'])){
  echo $error['signup'];
}
?>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="submit-btn">SIGN UP</button>
</form>
</div>
</section>

<?php require "footer.php"; ?>