
<?php
session_start();
  require_once('admin_header.php');
?>

<?php

include "../db/connection.php";



if(isset($_POST['submit'])){
  $faculty = $_POST['faculty'];
  $sql = "INSERT INTO faculty (faculty_name) VALUES ('$faculty')";
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
      <h1>Faculty Details</h1>
    </div><!-- End Page Title -->
    
    <section class="section dashboard">
      <div class="row">


        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Faculty</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" method="post">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Faculty Name</label>
                  <input type="text"  name="faculty"class="form-control" id="inputName5">
                </div>

                <div class="text-center">
                  <button type="submit" name ="submit"class="btn btn-primary">Submit</button>
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