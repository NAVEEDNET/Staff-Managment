<?php
session_start();
require_once('hod_header.php');
include "../db/connection.php";

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Inbox</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <?php
            $sql = "SELECT * FROM request_reject_details";
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rejected Details</h5>
                            <p>Request ID: <?php echo $row['request_id']; ?></p>
                            <p>Rejected Reason: <?php echo $row['rejected_reason']; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No rejection details found";
            }
            ?>
        </div>
    </section>

</main><!-- End #main -->

<?php
require_once('hod_footer.php');
?>
