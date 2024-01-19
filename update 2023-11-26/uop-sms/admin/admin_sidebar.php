<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="admin_dashboard.php">
      <i class="bi bi-grid"></i>
         <span>Admin Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <!-- Manage Details -->
  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Manage Details</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="add_staff.php">
              <i class="bi bi-circle"></i><span>Add Staff</span>
            </a>
          </li>
          <li>
            <a href="add_faculty.php">
              <i class="bi bi-circle"></i><span>Add Faculty</span>
            </a>
          </li>
          <li>
            <a href="add_department.php">
              <i class="bi bi-circle"></i><span>Add Department</span>
            </a>
          </li>
          <li>
            <a href="add_users.php">
              <i class="bi bi-circle"></i><span>Add Users</span>
            </a>
          </li>
         
    </ul>
      </li>
        <!-- End Manage Details -->

        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-text"></i>
          <span>Manage Requset</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="new_request.php">
              <i class="bi bi-circle"></i><span>New Requests</span>
            </a>
          </li>
          <li>
            <a href="old_request.php">
              <i class="bi bi-circle"></i><span>Old Requests</span>
            </a>
          </li>
        </ul>
      </li><!-- End Manage Request Nav -->

 

</ul>

</aside><!-- End Sidebar-->