<?php
session_start();
include "db/connection.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp1\htdocs\new update 26 - 11-2023  10.00 p.m\update 2023-11-26\PHPMailer-PHPMailer-2128d99\src\Exception.php';
require 'C:\xampp1\htdocs\new update 26 - 11-2023  10.00 p.m\update 2023-11-26\PHPMailer-PHPMailer-2128d99\src\PHPMailer.php';
require 'C:\xampp1\htdocs\new update 26 - 11-2023  10.00 p.m\update 2023-11-26\PHPMailer-PHPMailer-2128d99\src\SMTP.php';

if (isset($_POST['submit'])) {
    $userEmail = $con->real_escape_string($_POST['email']);

    $sql = "SELECT * FROM users WHERE user_email = '$userEmail'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $otp = rand(1000, 9999);

        $updateSql = "UPDATE users SET reset_code = ? WHERE user_email = ?";
        $stmt = $con->prepare($updateSql);
        $stmt->bind_param("ss", $otp, $userEmail);
        $stmt->execute();

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'fstaff928@gmail.com'; // Your Gmail email address
            $mail->Password   = 'cuml ohpx qghi pzng'; // Your Gmail password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or ENCRYPTION_SMTPS
            $mail->Port       = 587; // Check your SMTP port (465 for SSL)

            //Recipients
            $mail->setFrom('fstaff928@gmail.com', 'Your Name');
            $mail->addAddress($userEmail); // Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'Your OTP for verification is: ' . $otp;

            $mail->send();
            header("Location: verify_code.php?email=$userEmail");
            exit();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script> alert('Email not found') </script>";
    }
}
?>
<!-- Rest of your HTML code remains unchanged -->

<!-- Rest of your HTML code remains unchanged -->


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

              <!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                    <p class="text-center small">Enter your email to reset your password</p>
                  </div>

                  <form class="row g-3 " method="post">

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <div class="col-12">
                    <!-- <a href="verify_code.php" class="btn btn-primary w-100" name="submit" type="submit">Verify Email</a> -->
                    <button class="btn btn-primary w-100" name="submit" type="submit">Verify Email</button>

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
