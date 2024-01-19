<?php
session_start();
include "../db/connection.php";
require_once('admin_header.php');

if (isset($_SESSION['userId'])) {
    $user_id = $_SESSION['userId'];

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Handle profile image upload
        $newProfileImage = $_FILES['profileImage'];

        // Check if a file is uploaded
        if ($newProfileImage['size'] > 0) {
            // Handle the file upload and get the file path
            $targetDirectory = "uploads/";  // Set the directory where you want to store the images
            $targetFile = $targetDirectory . basename($newProfileImage["name"]);

            // Check if the directory exists, create it if not
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, true);
            }

            if (move_uploaded_file($newProfileImage["tmp_name"], $targetFile)) {
                // File uploaded successfully, update the user's data in the database
                $updateSql = "UPDATE users SET profile_image = ?, first_name = ?, last_name = ?, user_email = ? WHERE id = ?";
                $updateStmt = $con->prepare($updateSql);

                if ($updateStmt) {
                    $updateStmt->bind_param("ssssi", $targetFile, $_POST['fullName'], $_POST['lastName'], $_POST['email'], $user_id);

                    if ($updateStmt->execute()) {
                        echo "Profile updated successfully!";
                    } else {
                        echo "Error updating profile: " . $updateStmt->error;
                    }

                    $updateStmt->close();
                } else {
                    echo "Error in preparing update SQL statement.";
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            // No file uploaded, update other user data
            $updateSql = "UPDATE users SET profile_image = NULL, first_name = ?, last_name = ?, user_email = ? WHERE id = ?";
            $updateStmt = $con->prepare($updateSql);

            if ($updateStmt) {
                $updateStmt->bind_param("sssi", $_POST['fullName'], $_POST['lastName'], $_POST['email'], $user_id);

                if ($updateStmt->execute()) {
                    echo "Profile updated successfully!";
                } else {
                    echo "Error updating profile: " . $updateStmt->error;
                }

                $updateStmt->close();
            } else {
                echo "Error in preparing update SQL statement.";
            }
        }
    }

    // Handle image deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteImage'])) {
        // Delete the image from the database
        $deleteSql = "UPDATE users SET profile_image = NULL WHERE id = ?";
        $deleteStmt = $con->prepare($deleteSql);

        if ($deleteStmt) {
            $deleteStmt->bind_param("i", $user_id);

            if ($deleteStmt->execute()) {
                echo "Profile image deleted successfully!";
            } else {
                echo "Error deleting profile image: " . $deleteStmt->error;
            }

            $deleteStmt->close();
        } else {
            echo "Error in preparing delete SQL statement.";
        }
    }

    // Fetch user data for display
    $selectSql = "SELECT * FROM users WHERE id = ?";
    $selectStmt = $con->prepare($selectSql);

    if ($selectStmt) {
        $selectStmt->bind_param("i", $user_id);
        $selectStmt->execute();
        $result = $selectStmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Profile</title>
            </head>

            <body>

                <main id="main" class="main">

                    <div class="pagetitle">
                        <h1>Profile</h1>
                    </div><!-- End Page Title -->

                    <section class="section profile">
                        <div class="row">
                            <div class="col-xl-4">

                                <div class="card">
                                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                        <img src="<?php echo $row['profile_image']; ?>" alt="Profile" class="rounded-circle"
                                            id="profileImage">
                                        <h2><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h2>
                                        <h3><?php echo $row['user_email']; ?></h3>

                                    </div>
                                </div>

                            </div>

                            <div class="col-xl-8">

                                <div class="card">
                                    <div class="card-body pt-3">
                                        <!-- Bordered Tabs -->
                                        <ul class="nav nav-tabs nav-tabs-bordered">

                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab"
                                                    data-bs-target="#profile-overview">Overview</button>
                                            </li>

                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#profile-edit">Edit Profile</button>
                                            </li>

                                        </ul>
                                        <div class="tab-content pt-2">

                                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                                <h5 class="card-title">Profile Details</h5>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">First Name </div>
                                                    <div class="col-lg-9 col-md-8"><?php echo $row['first_name']; ?></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Last Name </div>
                                                    <div class="col-lg-9 col-md-8"><?php echo $row['last_name']; ?></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label ">User Type </div>
                                                    <div class="col-lg-9 col-md-8">Admin</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                                    <div class="col-lg-9 col-md-8"><?php echo $row['user_email']; ?></div>
                                                </div>

                                            </div>

                                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                                <!-- Profile Edit Form -->
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row mb-3">
                                                        <label for="profileImage"
                                                            class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <img id="profileImage" src="<?php echo $row['profile_image']; ?>"
                                                                alt="Profile">
                                                            <div class="pt-2">
                                                                <input type="file" name="profileImage" id="uploadInput"
                                                                    style="display: none;" onchange="previewImage(event)">
                                                                <label for="uploadInput" class="btn btn-primary btn-sm"
                                                                    title="Upload new profile image"><i
                                                                        class="bi bi-upload"></i></label>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    onclick="deleteImage(<?php echo $user_id; ?>)"
                                                                    title="Remove my profile image"><i
                                                                        class="bi bi-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="fullName"
                                                            class="col-md-4 col-lg-3 col-form-label">First Name </label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="fullName" type="text" class="form-control"
                                                                id="fullName" value="<?php echo $row['first_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="lastName"
                                                            class="col-md-4 col-lg-3 col-form-label">Last Name </label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="lastName" type="text" class="form-control"
                                                                id="lastName" value="<?php echo $row['last_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="userType"
                                                            class="col-md-4 col-lg-3 col-form-label">User Type </label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="userType" type="text" class="form-control"
                                                                id="userType" value="Admin" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="email"
                                                            class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="email" type="email" class="form-control"
                                                                id="email" value="<?php echo $row['user_email']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" name="submit" class="btn btn-primary">Save
                                                            Changes</button>
                                                    </div>
                                                </form><!-- End Profile Edit Form -->

                                            </div>

                                        </div><!-- End Bordered Tabs -->

                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                </main>

                <script>
                    // Function to preview the uploaded image
                    function previewImage(event) {
                        const input = event.target;
                        const file = input.files[0];

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const profileImage = document.getElementById("profileImage");
                                profileImage.src = e.target.result;
                            };

                            reader.readAsDataURL(file);
                        }
                    }

                    // Function to delete the uploaded image
                    function deleteImage(user_id) {
                        const profileImage = document.getElementById("profileImage");
                        const uploadInput = document.getElementById("uploadInput");

                        // Clear the image
                        profileImage.src = "";

                        // Clear the file input
                        uploadInput.value = "";

                        // Additionally, send an AJAX request to delete the image from the database
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "your_delete_image_php_file.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Handle the response if needed
                                console.log(xhr.responseText);
                            }
                        };

                        // Send user ID to identify which user's image to delete
                        xhr.send("user_id=" + user_id);
                    }
                </script>

            </body>

            </html>

<?php
        } else {
            echo "No user found with the specified ID.";
        }

        $selectStmt->close();
    } else {
        echo "Error in preparing select SQL statement.";
    }
} else {
    // Redirect to login page if the user is not logged in
    //header("Location: index.php");
    exit();
}

// Include your footer or any other necessary HTML
require_once('admin_footer.php');
?>