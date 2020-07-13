<?php
require_once __DIR__. '/../../helper/init.php';
$pageTitle = "Easy ERP | Dashboard";
$sidebarSection = "dashboard";
$sidebarSubSection = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once(__DIR__."/../includes/head-section.php"); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php require_once(__DIR__."/../includes/sidebar.php");?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php require_once(__DIR__."/../includes/navbar.php");?>

        <!-- Begin Page Content -->
    
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php require_once(__DIR__."/../includes/footer.php");?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php require_once(__DIR__."/../includes/scroll-to-top.php");?>

  <!-- Logout Modal-->
  <?php require_once(__DIR__."/../includes/page-level/logout-modal.php");?>

  <?php require_once(__DIR__."/../includes/core-scripts.php");?>

  <!-- Page level plugins -->
  <script src="<?= BASEASSETS?>vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= BASEASSETS?>js/demo/chart-area-demo.js"></script>
  <script src="<?= BASEASSETS?>js/demo/chart-pie-demo.js"></script>

</body>

</html>
