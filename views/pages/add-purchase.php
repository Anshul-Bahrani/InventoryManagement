<?php
require_once __DIR__ . '/../../helper/init.php';
$pageTitle = "Easy ERP | Add Purchase";
$sidebarSection = "transaction";
$sidebarSubSection = "purchase";
Util::createCSRFToken();
$errors = "";
$old="";
if(Session::hasSession('errors'))
{
  $errors = unserialize(Session::getSession('errors'));
  Session::unsetSession('errors');
}
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
      hr{
        border-top: 7px solid rgba(0, 0, 0, 0.1);
      }
    </style>
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
            <h1 class="h3 mb-0 text-gray-800">Purchase</h1>
            <a href="<?= BASEPAGES; ?>manage-category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fa fa-list-ul fa-sm text-white-75"></i> Manage Purchase
            </a>
          </div>


          
          <div class="card shadow mb-4">
            <div class="col-lg-12">
              <!-- Basic Card Example -->
              <!--CARD HEADER-->
              
  
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-lg-between">
               <h6 class="m-0 font-weight-bold text-primary">
                 <i class="fas fa-plus"></i>Sales
               </h6>
                  <button type="button"
                  onclick="addProduct();"
                  class="d-sm-inline-block btn btn-secondary shadow-sm">
                  <i class="fas fa-plus fa-sm text-white"></i>Add one more product
                  </button>
                </div>
                <!--END OF CARD HEADER-->

              <form action="../../helper/Routing.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?=Session::getSession('csrf_token');?>">
                <div class="card-body">
                  <div id="products_container">
                    <!-- Begin product custom control-->
                    <div class="product_row" id="element_1">
                        <div class="row ">
                            <!--Begin supplier select-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="supplier_1">Supplier</label>
                              <select id="supplier_1" name="supplier_id[]" class="form-control suppliers_select">
                              <option disabled selected>Supplier</option>
                              <?php
                              $suppliers = $di->get('database')->readData('suppliers', ['id','first_name','last_name'], "deleted=0");
                              foreach($suppliers as $supplier){
                                  echo "<option value='{$supplier->id}'>{$supplier->first_name} {$supplier->last_name}</option>";
                              }
                              ?>
                              </select>
                            </div>

                          </div>
                          <!--End supplier select-->
                          <!-- Begin category select-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="category_1">Category</label>
                              <select id="category_1" class="form-control category_select"
                              name="category_id[]"
                              >
                              <option disabled selected>Category</option>
                              <?php
                              $categories = $di->get('database')->readData('category', ['id','name'], "deleted=0");
                              foreach($categories as $category){
                                  echo "<option value='{$category->id}'>{$category->name}</option>";
                              }
                              ?>
                              </select>
                            </div>

                          </div> 
                          <!--End category select -->

                          <!--Begin product -->
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="">Products</label>
                                  <select name="product_id[]" id="product_1" class="form-control product_select">
                                      <option disabled selected>Select Product</option>
                                  </select>
                              </div>

                          </div>
                          <!--End product -->

                            </div>
                        <div class="row">
                          <!--Begin edit sp button-->
                          <div class="col-md-1">
                          <div class="form-group">
                          <label for="">Edit SP</label>
                              <button onclick="editSellingPrice(1)"
                              type="button"
                              class="btn btn-primary form-control"
                              data-toggle="modal" data-target="#editModal"
                              >
                              <i class="fa fa-pencil-alt"></i>
                              </button>                          
                          </div>
                          </div>
                          <!--End edit sp button-->
                              <!--Begin selling price -->
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="">S.P</label>
                                  <input type="text" name="selling_price[]" id="selling_price_1"
                                  class="form-control"
                                  disabled
                                  >
                              </div>
                          </div>
                          <!--End selling price-->

                          <!--Begin purchase rate -->
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="">C.P</label>
                                  <input type="text" name="purchase_rate[]" id="purchase_rate_1"
                                  class="form-control"
                                  >
                              </div>
                          </div>
                          <!--End purchase rate-->
                          <!--Begin quantity -->
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="">Quantity</label>
                                  <input type="number" value=0 name="quantity[]" id="quantity_1"
                                  class="form-control quantity_ip"
                                  placeholder="Enter Quantity">                              
                              </div>
                          </div>
                          <!--End quantity -->
                          <!-- Begin discount -->
                          <!-- <div class="col-md-1">
                              <div class="form-group">
                                  <label for="">Discount</label>
                                  <input type="number" value =0 name="discount[]" id="discount_1" class="form-control discount_ip" 
                                  placeholder="Enter Disount">
                              </div>
                          </div> -->
                          <!--End discount -->
                          
                          <!--Begin final rate -->
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="">Final</label>
                                  <input type="text" name="final_rate[]" id="final_rate_1"
                                  class="form-control"
                                  disabled
                                  value="0"
                                  >
                              </div>
                          </div>
                          <!--End final price-->
                          <!--Begin delete button-->
                          <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Delete</label>
                                    <button onclick="deleteProduct(1)"
                                    type="button"
                                    class="btn btn-danger form-control"
                                    >
                                    <i class="far fa-trash-alt"></i>
                                    </button>                          
                            </div>
                          </div>
                          <!--End delete button-->

                          
                        </div>
                        
                    </div>
                    
                    <!--end product custom control-->
                  </div>
                  

                </div>

                <!--End of card body-->
                <!-- begin card footer-->
                <div class="d-flex card-footer justify-content-between">
                  <div>
                  <input type="submit" class="btn btn-primary" name="confirm-purchase" value="submit">
                        </div>
                  <div class="form-group row">
                    <label for="finalTotal" class="col-sm-4 col-form-label">Final Total</label>
                    <div class="col-sm-8">
                      <input type="number" readonly class="form-control" id="finalTotal" value=0>
                    </div>
                  </div>
                </div>
              </form>
    </div>
    <!--end basic card-->


            </div>
          </div>
        
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <div>
      <?php require_once(__DIR__ . "/../includes/footer.php"); ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  
  <!--EDIT SP MODAL-->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit SP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= BASEURL;?>helper/routing.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?= Session::getSession('csrf_token');?>">
            <input type="hidden" name="product_id" id="product_id">
            <input type="hidden" name="element_id" id="element_id">
            <div class="form-group-row">
            <label for="name" class="col-sm-12">Product name</label>
                <input type="text" class="form-control" id="prod_name" name="prod_name">
                <label for="name" class="col-sm-12">New Selling Price</label>
                <input type="number" class="form-control" id="new_sp" name="new_sp">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="submit" name="editSellingPrice" onclick="addNewSellingPrice()">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--/EDIT SP MODAL-->
  <?php
  require_once(__DIR__ . "/../includes/scroll-to-top.php");
  ?>
  <?php require_once(__DIR__ . "/../includes/core-scripts.php"); ?>
  
  <!--PAGE LEVEL SCRIPTS-->
  <?php require_once(__DIR__ . "/../includes/page-level/transactions/add-purchase-scripts.php");?>
</body>

</html>
