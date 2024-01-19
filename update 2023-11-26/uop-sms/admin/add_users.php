
<?php
session_start();
require_once('admin_header.php');
?>

<?php
//session_start();
include "../db/connection.php";



if(isset($_POST['submit'])){
  $user_type = $_POST['type'];
  $first_name = $_POST['Fname'];
  $last_name = $_POST['lname'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);


  $file_tmp = $_FILES["image"]["tmp_name"];
  $file_name = $_FILES["image"]["name"]; // Extracting the file name
  $file_destination = './images/' . $file_name; // Concatenating the file name to the destination path
  
  if (move_uploaded_file($file_tmp, $file_destination)) {
      echo " " . $file_destination;
  } else {
      echo "Error uploading file!";
  }

  $sql = "INSERT INTO users (type_id, first_name, last_name, user_email, user_password, profile_image) 
        VALUES ('$user_type', '$first_name', '$last_name', '$email', '$password', '$file_destination')";

  $stmt = $con->prepare($sql);
 // $stmt->bind_param("isssss", $staff_type, $first_name, $last_name, $email, $password, $file_destination);
 if ($stmt->execute()) {
  echo "";
} else {
  echo "Error: " . $stmt->error; 
}

  $stmt->close();
}


?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add User</h1>
    </div><!-- End Page Title -->
    
    <section class="section dashboard">
      <div class="row">


        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Head Of Department</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" method="post" action="add_users.php" enctype="multipart/form-data">
                
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">First Name</label>
                  <input type="text"  name="Fname" class="form-control" id="inputName5">
                </div>

                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Last Name</label>
                  <input type="text" name ="lname"class="form-control" id="inputName5">
                </div>

                <div class="col-md-6">
                  <label for="inputState" class="form-label">Select User Type</label>
                  <select id="inputState" class="form-select" name = "type">
                    <option disabled selected>--Select User--</option>
                    <?php
                    $sql = "SELECT id, user_type FROM  user_type";
                    $result = $con->query($sql);
                     if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                     echo '<option value="' . $row['id'] . '">' . $row['user_type'] . '</option>';
                     }
                    } else {
                    echo '<option value="">No type available</option>';
                    }
                  ?> 
                    
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" name="email"class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Password</label>
                  <input type="password" name="password"class="form-control" id="inputPassword5">
                </div>

                <div class="col-md-6">
            <label for="inputNumber" class="form-label">Upload Image</label>
            <div class="col-md-8">
                <input class="form-control" type="file" name="image" id="formFile">
            </div>
        </div>
              
          

                <div class="text-center">
                  <button type="submit" name="submit"class="btn btn-primary" >submit</button>
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