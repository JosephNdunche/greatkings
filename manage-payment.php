<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}
?>
<?php
require_once "database/conn.php";

$error = array();

if(isset($_GET['unique_id'])){
    $student_id = $_GET['unique_id'];
}

    $sql = "SELECT * FROM users WHERE unique_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $student_id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        } else{
            "error";
        }
    

        $sql = "SELECT * FROM payment WHERE parent_id = ? AND verified='0'";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $student_id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $rows = $result->fetch_assoc();
        } else{
            "error";
        }
    ?>
    <?php
    if(isset($_POST['payment'])){
      $student_id = $_POST['student_id'];
      $scratch_card = bin2hex(random_bytes(8));
        $sql = "INSERT INTO scratch_card (student_id, scratch_card, verified, date) VALUES(?,?,'1', NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $student_id, $scratch_card);
        if($stmt->execute()){
            header("location: successful-payment.php");
        }

        }

?>
<?php
require_once "admin-header.php";
?>
<section class="signup pt-0 mb-5">
<h2 class="text-center">Manage Students</h2>
<div class="container">  

<main id="main" class="main">

    <div class="pagetitle">
      <h1 class="text-center">Verify Payment</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img style="height: 10rem;" src="uploads/<?php echo $rows['upload'];  ?>" alt="Profile" class="rounded">
              <h2><?php echo $row['parent_surname'] .' '. $row['parent_other_names'];  ?></h2>
              <h3><?php echo $rows['parent_id'];  ?></h3>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
              <button type="submit" class="btn btn-success" name="payment">Approve Payment</button>
            </div>
              </form>
          </div>

        </div>

               
</section>

<?php require_once "user-footer.php";  ?>