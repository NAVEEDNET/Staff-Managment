<?php
session_start();
include "db/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['otp'])) {
        $enteredOTP = $con->real_escape_string($_POST['otp']);

        // Check if the 'email' parameter exists in the URL
        if (isset($_GET['email'])) {
            $userEmail = $con->real_escape_string($_GET['email']);

            $sql = "SELECT reset_code FROM users WHERE user_email = '$userEmail'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $correctOTP = $row['reset_code'];

                if ($enteredOTP == $correctOTP) {
                    // OTP is correct, move to the next page
                    header("Location: new_password.php?email=$userEmail");
                    exit();
                } else {
                    // Incorrect OTP
                    echo "<script>alert('Incorrect OTP. Please try again.');</script>";
                }
            } else {
                // Invalid email or reset code
                echo "<script>alert('Invalid email or reset code.');</script>";
            }
        } else {
            // 'email' parameter is not provided in the URL
            echo "<script>alert('Email not provided.');</script>";
        }
    } else {
        // OTP not provided
        echo "<script>alert('OTP not provided.');</script>";
    }
} else {
    // Invalid request method
    echo "<script>alert('OTP provided to the email.');</script>";
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
                    <p class="text-center small">Enter your OTP Code to reset your password</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">OTP</label>
                      <input type="number" style="letter-spacing: 6px;" name="otp" class="form-control" id="yourEmail" oninput="limitLength(this, 4)" min="1000" max="9999" required>
                      <div class="invalid-feedback">Invalid OTP</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Verify Code</button>
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


  <script>
    function limitLength(input, maxLength) {
      let value = input.value;

      if (value.length > maxLength) {
        // Trim the input to the specified length
        value = value.slice(0, maxLength);

        // Update the input value
        input.value = value;
      }
    }
  </script>

  <!-- Vendor JS Files -->
  <!-- Include your vendor JS files here -->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>