<?php
//session_start();
require_once('hod_header.php');
include "../db/connection.php";


$sql = mysqli_query($con, "SELECT staff_type.id, staff_type.type_name from staff_type");
$sql1 = mysqli_fetch_all($sql, MYSQLI_ASSOC);

?>
<?php



// Assuming the 'request_by' is retrieved from the session and 'request_staff' comes from the form POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userId'])) {
  $requested_by = $_SESSION['userId'];
  $request_staff = $_POST['request_staff'] ?? '';
  $status_id = $_POST['status_id'];
  $request_field = $_POST['field'] ?? '';
  $request_value = $_POST['value'] ?? '';
  $remark = $_POST['remark'] ?? '';

  // Validate $request_staff (ensure it's a valid staff ID)

  // Perform the insertion into the request table
  $sql = "INSERT INTO request (request_by, request_staff, status_id, request_field, request_value, remark)
          VALUES ($requested_by, $request_staff, $status_id, '$request_field', '$request_value', '$remark')";

  // Execute the query and handle success/failure
  if ($con->query($sql) === TRUE) {
     // echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}

?>





<main id="main" class="main">
  <div class="pagetitle">
    <h1>New Request</h1>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Request</h5>

          <!-- Multi Columns Form -->
          <form class="row g-3" method="post" action="">
            <div class="col-md-6">
              <label for="requestField" class="form-label">Request Field</label>
              <select id="requestField" class="form-select" name="field" onchange="displaySelectedField()">
                <option value="type_name">Staff Type</option>
                <option value="title">Title</option>
                <option value="designation">Designation</option>
                <option value="faculty">Faculty</option>
                <option value="department">Department</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="requestValue" class="form-label">Request By</label>
              <input type="text"  name="request_by"class="form-control" id="inputName5">
            </div>

            <div class="col-md-6">
              <label for="requestValue" class="form-label">Request Staff</label>
              <select id="inputState" class="form-select" name="request_staff">
                  <?php
                    $sql = "SELECT id, staff_name FROM staff";
                    $result = $con->query($sql);
                     if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['staff_name'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No type available</option>';
                    }
                  ?> 
                  </select>
            </div>
           
            <div class="col-md-6">
              <label for="requestValue" class="form-label">Status Id</label>
              <select id="inputState" class="form-select" name="status_id">
                  <?php
                    $sql = "SELECT id, status FROM request_status";
                    $result = $con->query($sql);
                     if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['status'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No type available</option>';
                    }
                  ?> 
                  </select>
            </div>



            <div class="col-md-6">
              <label for="requestValue" class="form-label">Request Value</label>
              <select id="requestValue" class="form-select" name="value">
                <!-- Options will be dynamically populated using JavaScript -->
              </select>
            </div>

            <div class="col-md-6">
              <label for="inputName5" class="form-label">Remark :- </label>
              <textarea name="remark" class="form-control" id="inputName5" rows="4" cols="80" name="remark"></textarea>
            </div>
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>
    </div>
  </section>

  <script src="Request.js" defer></script>
</main><!-- End #main -->

<?php
require_once('hod_footer.php');
?>
