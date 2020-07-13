<?php
    require_once(__DIR__ . "/../../helper/init.php" );
    $sidebarSection = 'transaction';
    $sidebarSubSection = 'purchase' ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
  $title = 'Easy ERP';
?>
<?php require_once(__DIR__ . "/../includes/head-section.php") ?>
  <!-- Place Custom CSS File -->
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php require_once(__DIR__ . "/../includes/sidebar.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php require_once(__DIR__ . "/../includes/navbar.php") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <div class="list-group">
  <!-- <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small>3 days ago</small>
    </div>
    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
    <small>Donec id elit non mi porta.</small>
  </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small class="text-muted">3 days ago</small>
    </div>
    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
    <small class="text-muted">Donec id elit non mi porta.</small>
  </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small class="text-muted">3 days ago</small>
    </div>
    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
    <small class="text-muted">Donec id elit non mi porta.</small>
  </a> -->
</div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


    <?php require_once(__DIR__ . "/../includes/footer.php") ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->


<?php require_once(__DIR__ . "/../includes/scroll-to-top.php") ?>




<?php require_once(__DIR__ . "/../includes/core-scripts.php") ?>

  <!--PAGE LEVEL SCRIPTS-->
  <?php require_once(__DIR__ . "/../includes/page-level/transactions/all-invoices-scripts.php");?>
</body>
</html>