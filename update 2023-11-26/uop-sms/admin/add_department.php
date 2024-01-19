
<?php
session_start();
  require_once('admin_header.php');
?>
<?php

include "../db/connection.php";



if(isset($_POST['submit'])){
  $department = $_POST['department'];
  $sql = "INSERT INTO department (department_name) VALUES ('$department')";
  $stmt = $con->prepare($sql);
  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }
  $stmt->close();
}

?>




  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Department Details</h1>
    </div><!-- End Page Title -->
    
    <section class="section dashboard">
      <div class="row">


        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Department</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" method="post">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Department Name</label>
                  <input type="text"  name="department"class="form-control" id="inputName5">
                </div>

                <div class="text-center">
                  <button type="submit" name="submit"class="btn btn-primary">Submit</button>
                  <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>
    </div>
</div>
</section>
  </main><!-- End #main -->

<?php 
  require_once('admin_footer.php');
?>