<?php
  session_start();
  require_once('admin_header.php');
  include "../db/connection.php";
  if (!(isset($_SESSION['userId']))) {
    header("Location:../index.php");
  }
  $sql = "SELECT COUNT(*) AS staffCount FROM staff"; 
  $result = $con->query($sql);
  
  if ($result) {
      $row = $result->fetch_assoc();
      $staffCount = $row['staffCount'];


?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <!-- <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li> -->
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Staff <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>

                    <div class="d-flex align-items-center">
                    <h1> <b>  <?php echo $staffCount; ?> Staffs </b></h1>
                    </div>


                    <div class="ps-3">
                      <h6></h6>
                      <span class="text-danger small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
      </div>
    </section>

  </main>
  <?php

} else {
  // Handle query execution errors
  echo "Error: " . $con->error;
}



  ?>
  <!-- End #main -->

<?php 
  require_once('admin_footer.php');
?>