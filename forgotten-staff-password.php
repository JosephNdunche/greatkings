<?php

session_start();

if(isset($_SESSION['user'])){
    header("location: staff-dashboard.php");
}

?> 

<?php
require_once "includes/forgotten-staff-password.inc.php";
require "header.php";
 
?>



  <main id="main" class="main">

    <section class="section pt-2">
      <div class="row">
        <div class="col-xl-4">

        <div class="col-xl-8">
            <h2 class="text-center py-3">Forgotten Password</h2>

          <div class="card">
            <div class="card-body pt-3">

                  <!-- Change Password Form -->
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <div class="row mb-3">
                      <label for="uid" class="col-md-4 col-lg-3 col-form-label">Enter Unique Id</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="uid" type="text" class="form-control" id="uid" value="<?php if(isset($uid)){
                            echo $uid;
                        } ?>">
                        <div class="text-danger">
                            <?php
                            if(isset($error['uid'])){
                                echo $error['uid'];
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

  <?php require_once "footer.php"; ?>