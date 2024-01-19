
<?php
  require_once('hod_header.php');
?>
<?php
//session_start();
include "../db/connection.php";

// Fetch data from the staff table
$query = "select staff.staff_email,staff.staff_phone,staff.id, staff.staff_name,  staff_type.type_name,title_details.title_name,designation.designation_name,faculty.faculty_name,department.department_name from staff
inner join staff_type ON
staff.staff_type_id=staff_type.id
INNER JOIN title_details on 
staff.staff_title=title_details.id
INNER join designation ON
staff.designation_id=designation.id
INNER JOIN faculty ON
staff.faculty_id=faculty.id
INNER JOIN department ON
staff.department_id=department.id";
$result = mysqli_query($con, $query);

?>






  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Staff Details</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      <div class="col-lg-100">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Information</h5>
              <p></p>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Staff Type</th>
                    <th>Staff Tittle</th>
                    <th>Designation</th>
                    <th>Name</th>
                    <th>Faculty</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['type_name']; ?></td>
                                            <td><?php echo $row['title_name']; ?></td>
                                            <td><?php echo $row['designation_name']; ?></td>
                                            <td><?php echo $row['staff_name']; ?></td>
                                            <td><?php echo $row['faculty_name']; ?></td>
                                            <td><?php echo $row['department_name']; ?></td>
                                            <td><?php echo $row['staff_phone']; ?></td>
                                            <td><?php echo $row['staff_email']; ?></td>
                                            <td><a href ="Request.php" class ="btn btn-primary">Request</a></td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No data found</td></tr>";
                                }
                                ?>
                  
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
     </div>
    </section>

  </main><!-- End #main -->

<?php 
  require_once('hod_footer.php');
?>