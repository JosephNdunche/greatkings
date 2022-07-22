<?php

session_start();

if(!isset($_SESSION['staff'])){
    header("location: staff-signin.php");
}

require_once "includes/staff-profile.inc.php";
?>

<?php

require "staff-header.php";
 
?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="staff-dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Staff</li>
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
              <h3><?php echo $_SESSION['staff'];  ?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Staff Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['surname'] .' '. $_SESSION['other_names'];  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Staff Uid</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['staff'];  ?></div>
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

                
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php require_once "user-footer.php"; ?>