<?php
session_start();
require_once('admin_header.php');

include "../db/connection.php";

// Retrieve request IDs from the request table
$sql = "SELECT 	id FROM  request"; // Update with your actual table name
$result = $con->query($sql);

$request_ids = array(); // Store retrieved request IDs
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $request_ids[] = $row['id'];
    }
}

if (isset($_POST['submit'])) {
    $request_id = $_POST['Request_Field'];
    $reason = $_POST['reason'];

    // Insert into request_reject_details table with the selected request ID
    $sql_insert = "INSERT INTO request_reject_details (request_id , rejected_reason) VALUES ('$request_id', '$reason')";
    $stmt = $con->prepare($sql_insert);
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $con->error;
    }
    $stmt->close();
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Reject </h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reject Details</h5>

                    <!-- Multi Columns Form -->
                    <form class="row g-3" method="post">
                        <div class="col-md-6">
                            <label for="inputName5" class="form-label">Request Id :- </label>
                            <select name="Request_Field" class="form-control" id="inputName5">
                                <?php
                                foreach ($request_ids as $id) {
                                    echo "<option value='$id'>$id</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputName5" class="form-label">Reject Reason :- </label>
                            <textarea name="reason" class="form-control" id="inputName5" rows="4" cols="54"></textarea>
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
</main><!-- End #main -->

<?php
require_once('admin_footer.php');
?>
