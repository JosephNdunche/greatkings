<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

require_once "includes/admin-profile.inc.php";
?>

<?php

require "admin-header.php";
 
?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item">admin</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $_SESSION['image'];  ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION['surname'] .' '. $_SESSION['other_names']; ?></h2>
              <h3><?php echo $_SESSION['admin'];  ?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <!--<li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li> -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">admin Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['surname'] .' '. $_SESSION['other_names'];  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">admin Uid</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['admin'];  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Class Teacher</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['class'];  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date Of Birth</div>
                    <div class="col-lg-9 col-md-8"><?php if(($date_of_birth !== "")){
                      echo $date_of_birth;
                    }else{
                      echo "<span class='text-danger'>Update your profile</span>";
                    }  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State Of Origin</div>
                    <div class="col-lg-9 col-md-8"><?php if(($state_of_origin !== "")){
                      echo $state_of_origin;
                    }else{
                      echo "<span class='text-danger'>Update your profile</span>";
                    }  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php if(($address !== "")){
                      echo $address;
                    }else{
                      echo "<span class='text-danger'>Update your profile</span>";
                    }  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['telephone'];  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['email'];  ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <?php  require "includes/admin-update-profile.inc.php"; ?>
                  <!-- Profile Edit Form -->
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="uploads/<?php echo $_SESSION['image'];  ?>" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="surname" class="col-md-4 col-lg-3 col-form-label">Surname</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="surname" type="text" class="form-control" id="surname" value="<?php if(isset($_SESSION['surname'])){
                          echo $_SESSION['surname'];
                        }  ?>">
                        <div class="text-danger">
                          <?php
                          if(isset($error['surname'])){
                            echo $error['surname'];
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="other_names" class="col-md-4 col-lg-3 col-form-label">other_names</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="other_names" type="text" class="form-control" id="other_names" value="<?php if(isset($_SESSION['other_names'])){
                          echo $_SESSION['other_names'];
                        }  ?>">
                        <div class="text-danger">
                          <?php
                          if(isset($error['other_names'])){
                            echo $error['other_names'];
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Class Teacher</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="class" id="" class="form-control">
                          <option value="<?php if(isset($_SESSION['class'])){
                            echo $_SESSION['class'];
                          }else{
                            echo "";
                          } ?>"><?php if(isset($_SESSION['class'])){
                            echo $_SESSION['class'];
                          }else{
                            echo "Select Class";
                          } ?></option>
                          <option value="jss1">JSS1</option>
                          <option value="jss2 A">JSS2 A</option>
                          <option value="jss2 B">JSS2 B</option>
                          <option value="jss3">JSS3</option>
                          <option value="ss1">SS1</option>
                          <option value="ss2 A">SS2 A</option>
                          <option value="ss2 B">SS2 B</option>
                          <option value="ss3 A">SS3 A</option>
                          <option value="ss3 B">SS3 B</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="state_of_origin" class="col-md-4 col-lg-3 col-form-label">State of Origin</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="state_of_origin" type="text" class="form-control" id="state_of_origin" value="<?php if(isset($state_of_origin)){
                          echo $state_of_origin;
                        }else{
                          echo "Enter State of Origin";
                        } ?>">
                        <div class="text-danger">
                          <?php
                          if(isset($error['state_of_origin'])){
                            echo $error['state_of_origin'];
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="date_of_birth" type="date" class="form-control" id="date_of_birth" value="<?php if(isset($date_of_birth)){
                          echo $date_of_birth;
                        }else{
                          echo "Enter Date of Birth";
                        } ?>">
                        <div class="text-danger">
                          <?php
                          if(isset($error['date_of_birth'])){
                            echo $error['date_of_birth'];
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?php if(isset($address)){
                          echo $address;
                        }else{
                          echo "Enter Home Address";
                        } ?>">
                        <div class="text-danger">
                          <?php
                          if(isset($error['address'])){
                            echo $error['address'];
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="telephone" type="text" class="form-control" id="Phone" value="<?php if(isset($_SESSION['telephone'])){
                          echo $_SESSION['telephone'];
                        } ?>">
                        <div class="text-danger">
                          <?php
                          if(isset($error['telephone'])){
                            echo $error['telephone'];
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?php if(isset($_SESSION['email'])){
                          echo $_SESSION['email'];
                        } ?>">
                        <div class="text-danger">
                          <?php
                          if(isset($error['email'])){
                            echo $error['email'];
                          }
                          if(isset($error['profile'])){
                            echo $error['profile'];
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="admin-update-profile" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="other_names" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
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