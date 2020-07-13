<?php
require_once __DIR__ . '/../../helper/init.php';
$pageTitle = "Easy ERP | Add Category";
$sidebarSection = "category";
$sidebarSubSection = "add";
Util::createCSRFToken();
$errors = "";
if(Session::hasSession('errors'))
{
  $errors = unserialize(Session::getSession('errors'));
  Session::unsetSession('errors');
}
$old = "";
if(Session::hasSession('old'))
{
  $old = Session::getSession('old');
  Session::unsetSession('old');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once __DIR__ . "/../includes/head-section.php";
  ?>

  <!--PLACE TO ADD YOUR CUSTOM CSS-->

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
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <a href="<?= BASEPAGES; ?>manage-category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fa fa-list-ul fa-sm text-white-75"></i> Manage Category
            </a>
          </div>

          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                </div>
                <div class="card-body">
                  <div class="col-md-12">

                    <form action="<?=BASEURL;?>helper/routing.php" method="POST" id="add-category">
                      <input type="hidden" name="csrf_token" value="<?= Session::getSession('csrf_token');?>">
                      <!--FORM GROUP-->
                      <div class="form-group">
                        <label for="name">Category Name</label>
                        <input  type="text" 
                                name="name" 
                                id="name" 
                                class="form-control <?= $errors!='' && $errors->has('name') ? 'error' : '';?>"
                                placeholder = "Enter Category Name"
                                value="<?=$old != '' && isset($old['name']) ?$old['name']: '';?>"/>
                        <?php
                          if($errors!="" && $errors->has('name'))
                          {
                            echo "<span class='error'>{$errors->first('name')}</span>";
                          }
                        ?>
                      </div>
                      <!--/FORM GROUP-->
                      <button type="submit" class="btn btn-primary" name="add_category" value="addCategory"><i class="fa fa-check"></i> Submit</button>
                    </form>

                  </div>
                </div>
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
  <?php
  require_once(__DIR__ . "/../includes/scroll-to-top.php");
  ?>
  <?php require_once(__DIR__ . "/../includes/core-scripts.php"); ?>
  
  <!--PAGE LEVEL SCRIPTS-->
  <?php require_once(__DIR__ . "/../includes/page-level/category/add-category-scripts.php");?>
</body>

</html>