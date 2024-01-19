<?php
session_start();
include "db/connection.php";

if (isset($_POST['update'])) {
    $newpassword = $_POST['newpassword'];
    $confirm = $_POST['confirm'];

    if ($newpassword === $confirm) {
        // Hash the password using md5 (not recommended for secure password hashing)
        $hashedPassword = md5($newpassword);

        $userEmail = $_GET['email'];

        $sql = "UPDATE users SET user_password = ? WHERE user_email = ?";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $hashedPassword, $userEmail);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Password update failed. No rows were affected.";
                }
            } else {
                echo "Error executing the statement: " . $stmt->error;
            }
        } else {
            echo "Error in the prepared statement: " . $con->error;
        }
    } else {
        echo "Passwords do not match";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Forgot Password</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/uop-logo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body style="background-image: url('uop2.jpg');background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;">

  <main>
    <div class="container">

      <!-- Forgot Password Section -->
      <section class="section forgot-password min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">UOP - SMS</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                    <p class="text-center small">Enter your email to reset your password</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate  method="post">

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">New Password</label>
                      <input type="password" name="newpassword" class="form-control" id="yourPassword" required>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confirm Password</label>
                      <input type="password" name="confirm" class="form-control" id="yourPassword" required>
                    </div>

                    <div class="col-12">
                    <button class="btn btn-primary w-100" name="update" type="submit">Change Password</button>

                    </div>
                    <div class="col-12 text-center">
                      <a href="index.php">Back to Login</a>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <!-- Include your vendor JS files here -->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
