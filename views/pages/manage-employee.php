<?php
require_once __DIR__ . '/../../helper/init.php';
$pageTitle = "Easy ERP | Manage Employee";
$sidebarSection = "employee";
$sidebarSubSection = "manage-employee";
Util::createCSRFToken();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once __DIR__ . "/../includes/head-section.php"; ?>
  <!--PLACE TO ADD YOUR CUSTOM CSS-->
  <link rel="stylesheet" href="<?= BASEASSETS; ?>vendor/toastr/toastr.min.css">
  <link href="<?= BASEASSETS; ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php require_once(__DIR__ . "/../includes/sidebar.php"); ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php require_once(__DIR__ . "/../includes/navbar.php"); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employee</h1>
            <a href="<?= BASEPAGES; ?>add-employee.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fa fa-plus fa-sm text-white-75"></i> Add Employee
            </a>
          </div>

          <!--MANAGE employee DATATABLE-->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Manage Employees</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="manage-employee-datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Employee First Name</th>
                      <th>Employee Last Name</th>
                      <th>Employee Phone Number</th>
                      <th>Employee Email Id</th>
                      <th>Employee Gender</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require_once(__DIR__ . "/../includes/footer.php"); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!--EDIT MODAL-->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= BASEURL;?>helper/routing.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?= Session::getSession('csrf_token');?>">
            <input type="hidden" name="employee_id" id="employee_id">
            <div class="form-group-row">
                <label for="name" class="col-sm-12">Employee First Name</label>
                <input type="text" class="form-control" id="employee_first_name" name="employee_first_name">
                <label for="name" class="col-sm-12">Employee Last Name</label>
                <input type="text" class="form-control" id="employee_last_name" name="employee_last_name">
                <label for="name" class="col-sm-12">Employee Phone Number</label>
                <input type="text" class="form-control" id="employee_phone_no" name="employee_phone_no">
                <label for="name" class="col-sm-12">Employee Email Id</label>
                <input type="text" class="form-control" id="employee_email_id" name="employee_email_id">
                <label for="name" class="col-sm-12">Employee Gender</label>
                <input type="text" class="form-control" id="employee_gender" name="employee_gender">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="edit_employee">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--/EDIT MODAL-->


  <!--DELETE MODAL-->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= BASEURL;?>helper/routing.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?= Session::getSession('csrf_token');?>">
            <input type="hidden" name="record_id" id="record_id">
            <p>Are you sure you want to delete this record?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" name="delete_employee">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--/DELETE MODAL-->
  <?php
  require_once(__DIR__ . "/../includes/scroll-to-top.php");
  ?>
  <?php require_once(__DIR__ . "/../includes/core-scripts.php"); ?>
  <!--PAGE LEVEL SCRIPTS-->
  <?php require_once(__DIR__ . "/../includes/page-level/employee/manage-employee-scripts.php"); ?>


</body>

</html>