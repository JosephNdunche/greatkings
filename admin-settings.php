<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

?>

<?php
require "admin-header.php";
?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item">admin</li>
          <li class="breadcrumb-item active">settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">

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

                </div>

                
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php require_once "user-footer.php"; ?>