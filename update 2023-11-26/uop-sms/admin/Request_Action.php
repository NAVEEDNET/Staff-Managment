<?php
session_start();
require_once('admin_header.php');
include "../db/connection.php";

if (isset($_POST['submit'])) {
    $staff_id = $_POST['staff_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $title = $_POST['title'];
    $designation_id = $_POST['designation'];
    $faculty_id = $_POST['faculty'];
    $department_id = $_POST['department'];
    $staff_type_id = $_POST['Staff_type'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];


    // Check if the selected IDs exist in their respective tables
    if (checkExistence($con, $designation_id, 'designation') &&
        checkExistence($con, $faculty_id, 'faculty') &&
        checkExistence($con, $department_id, 'department') &&
        checkExistence($con, $staff_type_id, 'staff_type')
    ) {
        $sql = "UPDATE staff SET 
            staff_title = ?, 
            designation_id = ?, 
            faculty_id = ?, 
            department_id = ?, 
            staff_type_id = ?,
            staff_name = ?,
            gender = ?,
            staff_phone = ?,
            staff_email = ?,
            s_status = ?,
            remark = ?
            WHERE id = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param('siiissssisss', $title, $designation_id, $faculty_id, $department_id, $staff_type_id, $name, $gender, $phone, $email, $status, $remark , $staff_id);

        $title = $_POST['title'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];

        $stmt->execute();

        // Check for successful update
        if ($stmt->affected_rows > 0) {
            // Update successful
            echo "Success: Record updated successfully";
        } else {
            // No rows affected, handle the error
            echo "Error: Update failed";
        }

        $stmt->close();
    } else {
        // One of the foreign keys does not exist
        echo "Error: One of the selected foreign keys does not exist!";
    }
}

// Function to check the existence of a given ID in a table
function checkExistence($con, $id, $table)
{
    $check_sql = "SELECT id FROM $table WHERE id = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param('i', $id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    return $check_result->num_rows > 0;
}
?>

<!-- Your HTML form goes here -->
<main id="main" class="main">

<div class="pagetitle">
  <h1>Staff Member</h1>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Uptade Staff Information</h5>
        
        <!-- Multi Columns Form -->
        <form class="row g-3" method ="post" action="">
          <div class="col-md-6">
            <label for="inputName5"  class="form-label">Staff id</label>
            <input type="text" class="form-control" id="inputName5" name="staff_id">
          </div>
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
            <input type="text" class="form-control" id="inputName5" name="name">
          </div>

          <div class="col-md-6">
            <label for="inputEmail5"  class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail5" name="email">
          </div>

          <div class="col-md-6">
            <label for="inputPassword5" class="form-label">Phone</label>
            <input type="number" class="form-control" id="inputPassword5" name="phone">
          </div>

          <div class="col-md-6">
            <label for="inputState" class="form-label">Select Gender</label>
            <select id="inputState" class="form-select" name ="gender">
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
            
          <div class="col-md-6">
            <label for="inputState"  class="form-label">Title</label>
            <select id="inputState" class="form-select" name="title">
              
              
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
            <select id="inputState" class="form-select" name="designation">
              
              
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
            <select id="inputState"  name ="faculty"class="form-select">


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
            <select id="inputState" class="form-select" name="department">


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
                  <select id="inputState" class="form-select" name="status">
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
            <button type="submit" name="submit" class="btn btn-primary">update</button>
            <button type="reset" name="reset"class="btn btn-secondary">Reset</button>
          </div>
          
        </form>
        <!-- End Multi Columns Form -->

      </div>
    </div>
  </div>
</section>
</main><!-- End #main -->

<?php 
require_once('admin_footer.php');
?>