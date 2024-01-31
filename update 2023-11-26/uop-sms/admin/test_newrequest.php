<?php
session_start();
require_once('admin_header.php');
include "../db/connection.php";


if (!isset($_SESSION['requests']) || empty($_SESSION['requests'])) {
    $_SESSION['requests'] = fetchNewRequests($con);
}


if (!empty($_SESSION['requests'])) {
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>New Requests</h1>
    </div>

    <section class="section dashboard">
        <?php foreach ($_SESSION['requests'] as $request) { ?>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Details</h5>
                        <p>Request Field:
                            <div class="col-md-6">
                                <label for="requestField" class="form-label">Request Field</label>
                                <select id="requestField" class="form-select" name="field" onchange="displaySelectedField()">
                                    <option value="type_name" <?php echo ($request['request_field'] == 'type_name') ? 'selected' : ''; ?>>Staff Type</option>
                                    <option value="title" <?php echo ($request['request_field'] == 'title') ? 'selected' : ''; ?>>Title</option>
                                    <option value="designation" <?php echo ($request['request_field'] == 'designation') ? 'selected' : ''; ?>>Designation</option>
                                    <option value="faculty" <?php echo ($request['request_field'] == 'faculty') ? 'selected' : ''; ?>>Faculty</option>
                                    <option value="department" <?php echo ($request['request_field'] == 'department') ? 'selected' : ''; ?>>Department</option>
                                </select>
                            </div>
                        </p>

                        <p>Request Staff:
                            <div class="col-md-6">
                                <label for="requestValue" class="form-label">Request Staff</label>
                                <select id="inputState" class="form-select" name="request_staff">
                                    <?php
                                    $staffSql = "SELECT id, staff_name FROM staff";
                                    $staffResult = $con->query($staffSql);
                                    if ($staffResult->num_rows > 0) {
                                        while ($row = $staffResult->fetch_assoc()) {
                                            echo '<option value="' . $row['id'] . '" ' . (($request['request_staff'] == $row['id']) ? 'selected' : '') . '>' . $row['staff_name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No staff available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </p>

                        <p>Request Value:
                            <div class="col-md-6">
                                <label for="requestValue" class="form-label">Request Value</label>
                                <select id="requestValue" class="form-select" name="value">
                                 
                                </select>
                            </div>
                        </p>

                        <p>Remark: <?php echo $request['remark']; ?></p>

                        <a href="Old_request.php" class="btn btn-primary" name="accept">Accept</a>
                        <a href="Reject.php" class="btn btn-primary" name="reject">Reject</a>

                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</main><!-- End #main -->

<?php
} else {
    echo "<p>No more requests</p>";
}

require_once('admin_footer.php');

function fetchNewRequests($con)
{
    $requests = [];
    $sql = "SELECT * FROM request ";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $requests[] = $row;
        }
    }

    return $requests;
}

$request = fetchNewRequests($con)
?>
<script src="../Request.js" defer></script>
