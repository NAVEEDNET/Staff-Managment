<?php
session_start();
require_once('admin_header.php');
include "../db/connection.php";


function fetchCompletedRequests($con) {
    $completedRequests = [];
    $sql = "SELECT * FROM request"; 
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $completedRequests[] = $row;
        }
    }

    return $completedRequests;
}

$completedRequests = fetchCompletedRequests($con);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Old Requests</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <?php foreach ($completedRequests as $request) { ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Completed Request Details</h5>
                        <p>Request Field: <?php echo $request['request_field']; ?></p>
                        <p>Request Staff: <?php echo $request['request_staff']; ?></p>
                        <p>Request Value: <?php echo $request['request_value']; ?></p>
                        <p>Remark: <?php echo $request['remark']; ?></p>
                        
                            <a href ="Request_Action.php" id=<?php echo $request['id']; ?> class ="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-secondary">
                            Mark as read
                           </button>
                        
                        
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main>




<?php 
require_once('admin_footer.php');
?>
