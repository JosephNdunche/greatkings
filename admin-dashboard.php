<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

require_once "admin-header.php";
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="staff-dashboard.php">Admin</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      <?php
      require "database/conn.php";
      $sql = "SELECT * FROM pta ORDER BY date desc";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0){
        while($fetch = $result->fetch_assoc()){
          echo '
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
  
              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
  
  
                  <div class="card-body">
                    <h5 class="card-title">to '.$fetch['user'].'<span> | '.$fetch['date'].'</span></h5>
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-briefcase"></i>
                      </div>
                      <div class="ps-1">
                        <h6>'.$fetch['topic'].'</h6>
                        <span class="text-muted small pt-2 ps-1">'.$fetch['comment'].'</span>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Sales Card -->
  
              ';
        }
      }else{
      ?>    
         
           <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title text-center"></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <div class="ps-1">
                      <h6>Welcome, <?php echo $_SESSION['surname']; ?></h6>
                      <span class="text-muted small pt-2 ps-1">You can easily send message to parents or teachers and they will also get the information on their email.</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
<?php } ?>
            
      </div>
    </section>

  </main><!-- End #main -->

  <?php require_once "user-footer.php"; ?>