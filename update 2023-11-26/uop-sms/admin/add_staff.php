
<?php
session_start();
  require_once('admin_header.php');
?>
<?php
//session_start();
include "../db/connection.php";

if(isset($_POST['submit'])){
  $staff_type = $_POST['Staff_type'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $title = $_POST['title'];
  $designation = $_POST['designation'];
  $faculty = $_POST['faculty'];
  $department = $_POST['department'];
  $status=$_POST['status']; // Fixed: Changed $_post to $_POST
  $remark = $_POST['remark']; // Added missing semicolon here
  
  $sql = "INSERT INTO staff (staff_type_id, staff_name, staff_email, staff_phone, gender, staff_title, designation_id, faculty_id, department_id, s_status, remark) 
          VALUES ('$staff_type', '$name', '$email', '$phone', '$gender', '$title', '$designation', '$faculty', '$department', '$status', '$remark')";
  
  $stmt = $con->prepare($sql);
  
  if ($stmt->execute()) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $stmt->error;
  }

  $stmt->close();
}





?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Staff Member</h1>
    </div><!-- End Page Title -->
    
    <section class="section dashboard">
      <div class="row">


        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Staff Member</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" method ="post" action="">
              <div class="col-md-6">
                  <label for="inputState"  class="form-label">Staff Type</label>
                  <select id="inputState" class="form-select" name="Staff_type">
                  <?php
                    $sql = "SELECT id, type_name FROM staff_type";
                    $result = $con->query($sql);
                     if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['type_name'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No type available</option>';
                    }
                  ?> 
                  </select>
                </div>
              
                <div class="col-md-6">
                  <label for="inputName5"  class="form-label">Name</label>
                  <input type="text" class="form-control" id="inputName5" name="name" required>
                </div>
                <div class="col-md-6">
                      <label for="inputEmail5" class="form-label">Email</label>
                      <input type="email" class="form-control" id="inputEmail5" name="email" required>
                      <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                    <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="inputPassword5" name="phone" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required>
                        <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                    </div>

                <div class="col-md-6">
                  <label for="inputState" class="form-label">Select Gender</label>
                  <select id="inputState" class="form-select" name ="gender" required>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                
                <div class="col-md-6">
                  <label for="inputState"  class="form-label">Title</label>
                  <select id="inputState" class="form-select" name="title" required>
                  <?php
                    $sql = "SELECT id, title_name FROM title_details";
                    $result = $con->query($sql);
                     if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['title_name'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No title available</option>';
                    }
                  ?> 
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="inputState" class="form-label">Designation</label>
                  <select id="inputState" class="form-select" name="designation" required>
                  <?php
                    $sql = "SELECT id, designation_name FROM designation";
                    $result = $con->query($sql);
                     if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['designation_name'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No title designation</option>';
                    }
                  ?>
                    
                  </select>
                </div>
              
                <div class="col-md-6">
                  <label for="inputState" class="form-label">Faculty</label>
                  <select id="inputState"  name ="faculty"class="form-select" required >
                  <?php
        
                   $sql = "SELECT id, faculty_name FROM faculty";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
            
                    while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['faculty_name'] . '</option>';
                    }
                   } else {
                   echo '<option value="">No faculties available</option>';
                   }
                  ?>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="inputState" class="form-label">Department</label>
                  <select id="inputState" class="form-select" name="department" required>
                  <?php
        
                    $sql = "SELECT id, department_name FROM department";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
 
                    while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['department_name'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No department available</option>';
                    }
                  ?>
                    
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="inputState" class="form-label">Staff status</label>
                  <select id="inputState" class="form-select" name="status" required>
                  <?php
        
                    $sql = "SELECT id, 	staff_status  FROM staff_status";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
 
                    while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['staff_status'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No status available</option>';
                    }
                  ?>
                    
                  </select>
                </div>
                <div class="col-md-6">
              <label for="inputName5" class="form-label">Remark :- </label>
              <textarea  name="remark" class ="form-control" id="inputName5"rows="4" cols="54"></textarea>
            </div>




                <div class="text-center">
                  <input type="submit" name="submit" class="btn btn-primary">
                  <button type="reset" name="reset"class="btn btn-secondary">Reset</button>
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