<?php 
session_start(); 

if(isset($_SESSION['staff'])){
    header("location: staff-dashboard.php");
}
require "includes/staff-signup.inc.php";

?>
<?php
require "header.php";

?>
<section class="signup py-4">
<h2 class="text-center">Staff Signup</h2>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

  <div class="mb-3 mt-3">
    <label for="surname" class="form-label">Surname:</label>
    <input type="text" class="form-control" id="surname" placeholder="Enter Surname" name="surname" value="<?php if(isset($surname)){
        echo $surname;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['surname'])){
  echo $error['surname'];
}
?>
    </div>
  </div>
  <div class="mb-3 mt-3">
    <label for="other-names" class="form-label">Other Names:</label>
    <input type="text" class="form-control" id="other-names" placeholder="Enter Other Names" name="other_names" value="<?php if(isset($other_names)){
        echo $other_names;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['other_names'])){
  echo $error['other_names'];
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
    <label for="class" class="form-label">class teacher:</label>
    <select name="class" id="class" class="form-control">
        <option value="<?php if(isset($class)){
          echo $class;
        }else{
          echo " ";
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
        <option value="not a class teacher">Not a class teacher</option>
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
?>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="submit-btn">SIGN UP</button>
</form>
</div>
</section>

<?php require "footer.php"; ?>