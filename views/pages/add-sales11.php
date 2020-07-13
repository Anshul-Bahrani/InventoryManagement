<?php
require_once __DIR__ . '/../../helper/init.php';
$title = "Easy ERP | Add Sales";
$sidebarSection = "transaction";
$sidebarSubSection = "sales";
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
  <style>
      .email-verify {
          background: green;
          color: #FFF;
          padding: 5px 10px;
          font-size: .875;
          line-height: 1.5;
          display: none !important;
      }
  </style>

  <!--PLACE TO ADD YOUR CUSTOM CSS-->
  <link href="<?= BASEASSETS?>css/form.css" rel="stylesheet">
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
        <!-- .container-fluid -->
        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sales</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fa fa-list-ul fa-sm text-white-75"></i> Manage Sales
            </a>
          </div>



          <div class="row">
            <div class="col-lg-12">

              <!-- BEGIN: Basic Card -->
              <div class="card shadow mb-4">
                <div class="card-header py-3 px-2 d-flex flex-row justify-content-end">
                    <div class="mr-3">
                        <input type="text" class="form-control" name="email" id="customer_email" placeholder="Enter email of customer">
                    </div>
                    <div>
                        <p class="email-verify" id="email_verify_success">
                            <i class="fas fa-times fa-sm text-white"></i>Email Verified
                        </p>
                        <p class="email-verify bg-danger d-inline-block mb-0" id="email_verify_fail">
                            <i class="fas fa-times fa-sm text-white mr-1"></i>Email Not Verified
                        </p>
                        <a href="<?= BASEPAGES; ?>add-customer.php"
                            class="btn btn-sm btn-warning shadow-sm d-inline-block" id="add-customer_btn"
                            style="display: none!important">
                            <i class="fas fa-envelope fa-sm text-white" aria-hidden="true"></i>Add Customer
                        </a>
                        <button type="button" class="d-sm-inline-block btn btn-primary shadow-sm" name="check_email" id="check_email">
                            <i class="fas fa-envelope fa-sm text-white" aria-hidden="true"></i> Check Email
                        </button>
                    </div>
                </div>
                <div class="card-header py-3 d-flex flex-row justify-content-between align-items-end">
                  <h6 class="m-0 font-weight-bold text-primary">Add Sales</h6>
                  <button type="button"
                  onclick="addProduct();"
                  class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm">

                    <i class="fas fa-plus fa-sm text-white"></i>Add one More Product

                  </button>
                </div>


                    <form action="<?=BASEURL;?>helper/routing.php" method="POST">
                      <input type="hidden" name="csrf_token" value="<?= Session::getSession('csrf_token');?>">
                      <input type="text" name="customer_id" id="customer_id">
                      <div class="card-body">
                        <div id="products_container">
                            <!-- BEGIN: PRODUCT CUSTOM CONTROL -->
                            <div class="row product_row" id="element_1">
                            <!-- BEGIN: CATEGORY SELECT -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="category_1">Category</label>
                                    <select id="category_1" class="form-control category_select">
                                        <option disabled selected>Select Category</option>
                                        <?php
                                        $categories = $di->get('database')->readData("category", ["id", "name"], "deleted=0");
                                        foreach($categories as $category){
                                            echo"<option value='{$category->id}'>{$category->name}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- END: CATEGORY SELECT -->
                            <!-- BEGIN: PRODUCT SELECT -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_1">Products</label>
                                    <select name="product_id[]" id="product_1" class="form-control">
                                        <option disabled selected>Select Product</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END: PRODUCT SELECT -->
                            <!-- BEGIN: Quantity -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="quantity_1">Quantity</label>
                                    <input type="number" name="quantity[]" id="quantity_1" class="form-control" placeholder="Enter Quantity">
                                </div>
                            </div>
                            <!-- END: Quantity -->
                            <!-- BEGIN: Discount -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="discount_1">Discount</label>
                                    <input type="text" name="discount[]" id="discount_1" class="form-control" placeholder="Enter Discount">
                                </div>
                            </div>
                            <!-- END: Discount -->
                            <!-- BEGIN: Selling Price -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="selling_price_1">Selling Price</label>
                                    <input type="text" id="selling_price_1" class="form-control" disabled>
                                </div>
                            </div>
                            <!-- END:  Selling Price -->
                            <!-- BEGIN: DELETE BUTTON -->
                            <div class="col-md-1">
                                <button onclick="deleteProduct(1)" type="button" class="btn btn-danger" style="margin-top: 40%;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </div>
                            <!-- END:  DELETE BUTTON -->
                            </div>
                            <!-- END: PRODUCT CUSTOM CONTROL -->
                        </div>

                        <button type="submit" class="btn btn-primary" name="page" value="add_sales"><i class="fa fa-check"></i> Sale</button>
                      </div>
                    </form>
              </div>
              <!--END: Basic Card -->
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
  <?php require_once(__DIR__ . "/../includes/page-level/transactions/add-sales-scripts.php");?>
</body>

</html>
