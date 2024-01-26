<?php
session_start();
require_once('admin_header.php');
include "../db/connection.php";

// Fetch and store requests in the session if not already stored
if (!isset($_SESSION['requests']) || empty($_SESSION['requests'])) {
    $_SESSION['requests'] = fetchNewRequests($con);
}

// Display requests if available in the session
if (!empty($_SESSION['requests'])) {
?>

<?php




?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>New Requests</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <?php foreach ($_SESSION['requests'] as $request) { ?>
        <div class="row">
            
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Details</h5>
                        <p>Request Field: <?php echo $request['request_field']; ?></p>
                        <p>Request Staff: <?php echo $request['request_staff']; ?></p>
                        <p>Request Value: <?php echo $request['request_value']; ?></p>
                        <p>Remark: <?php echo $request['remark']; ?></p>
                        
                        <a href="Old_request.php" class="btn btn-primary" name ="accept">Accept</a>
                        <a href="Reject.php" class="btn btn-primary" name ="reject">Reject</a>
                        
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main><!-- End #main -->
<?php
} else {
    echo "<p>No more requests</p>";
}

require_once('admin_footer.php');

function fetchNewRequests($con) {
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
 <!-- $sql = "SELECT r.request_id, s.staff_name, rv.request_value
FROM request r
JOIN Staff s ON r.staff_id = s.staff_id
JOIN RequestValues rv ON r.request_value_id = rv.request_value_id"; -->
