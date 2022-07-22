<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}
?>
<?php
require_once "admin-header.php";
?>
<section class="signup pt-0 mb-5">
<h2 class="text-center">Manage Students</h2>
<div class="container">
  
<?php require "includes/admin-action.inc.php"; ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1 class="text-center">Student Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $rows['parent_image'];  ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $rows['student_names'];  ?></h2>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">

              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Student Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['student_names'] ;  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Parent Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['parent_surname'] . ' ' . $rows['parent_other_names'];  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Class</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['class']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Student Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['date_of_birth']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State of Origin</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['state_of_origin']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['home_address']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['telephone'];  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $rows['email'];  ?></div>
                  </div>

                </div>

               
</section>

<?php require_once "user-footer.php";  ?>