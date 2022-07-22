<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

?>

<?php
require_once "includes/change-admin-password.inc.php";
require "admin-header.php";
 
?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Password</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item">admin</li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">

                  <!-- Change Password Form -->
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                        <div class="text-danger">
                            <?php
                            if(isset($error['password'])){
                                echo $error['password'];
                            }
                            ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                        <div class="text-danger">
                            <?php
                            if(isset($error['newpassword'])){
                                echo $error['newpassword'];
                            }
                            ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                        <div class="text-danger">
                            <?php
                            if(isset($error['renewpassword'])){
                                echo $error['renewpassword'];
                            }
                            ?>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="password-btn">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php require_once "user-footer.php"; ?>