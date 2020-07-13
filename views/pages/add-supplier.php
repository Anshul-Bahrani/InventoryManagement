<?php
require_once __DIR__ . '/../../helper/init.php';
$pageTitle = "Easy ERP | Add Suppliers";
$sidebarSection = "supplier";
$sidebarSubSection = "add-supplier";
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
            <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
            <a href="<?= BASEPAGES; ?>manage-supplier.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fa fa-list-ul fa-sm text-white-75"></i> Manage Supplier
            </a>
          </div>

          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Supplier</h6>
                </div>
                <div class="card-body">
                  <div class="col-md-12">

                    <form action="<?=BASEURL;?>helper/routing.php" method="POST" id="add-supplier">
                    <input type="hidden" name="csrf_token" value="<?= Session::getSession('csrf_token');?>">
                      <!--FORM GROUP-->
                      <div class="form-group">
                        <label for="name">First Name</label>
                        <input  type="text" 
                                name="first_name" 
                                id="first_name" 
                                class="form-control <?= $errors!='' && $errors->has('first_name') ? 'error' : '';?>"
                                placeholder = "Enter First Name"
                                value="<?=$old != '' && isset($old['first_name']) ?$old['first_name']: '';?>"/>
                                
                        <label for="name">Last Name</label>
                        <input  type="text" 
                                name="last_name" 
                                id="last_name" 
                                class="form-control <?= $errors!='' && $errors->has('last_name') ? 'error' : '';?>"
                                placeholder = "Enter Last Name"
                                value="<?=$old != '' && isset($old['last_name']) ?$old['last_name']: '';?>"/>
                                
                        <label for="name">Address</label>
                        <input  type="text" 
                                name="street" 
                                id="street" 
                                class="form-control <?= $errors!='' && $errors->has('street') ? 'error' : '';?>"
                                placeholder = "Enter Street Name"
                                value="<?=$old != '' && isset($old['street']) ?$old['street']: '';?>"/>
                                
                        <input  type="text" 
                                name="city" 
                                id="city" 
                                class="form-control <?= $errors!='' && $errors->has('city') ? 'error' : '';?>"
                                placeholder = "Enter City Name"
                                value="<?=$old != '' && isset($old['city']) ?$old['city']: '';?>"/>
                                
                        <input  type="text" 
                                name="pincode" 
                                id="pincode" 
                                class="form-control <?= $errors!='' && $errors->has('pincode') ? 'error' : '';?>"
                                placeholder = "Enter Pincode"
                                value="<?=$old != '' && isset($old['pincode']) ?$old['pincode']: '';?>"/>
                                
                        <input  type="text" 
                                name="state" 
                                id="state" 
                                class="form-control <?= $errors!='' && $errors->has('state') ? 'error' : '';?>"
                                placeholder = "Enter State"
                                value="<?=$old != '' && isset($old['state']) ?$old['state']: '';?>"/>

                        <input  type="text" 
                                name="country" 
                                id="country" 
                                class="form-control <?= $errors!='' && $errors->has('country') ? 'error' : '';?>"
                                placeholder = "Enter Country Name"
                                value="<?=$old != '' && isset($old['country']) ?$old['country']: '';?>"/>

                        <input  type="text" 
                                name="town" 
                                id="town" 
                                class="form-control <?= $errors!='' && $errors->has('town') ? 'error' : '';?>"
                                placeholder = "Enter Town Name"
                                value="<?=$old != '' && isset($old['town']) ?$old['town']: '';?>"/>

                        <input  type="text" 
                                name="block_no" 
                                id="block_no" 
                                class="form-control <?= $errors!='' && $errors->has('block_no') ? 'error' : '';?>"
                                placeholder = "Enter Block Number"
                                value="<?=$old != '' && isset($old['block_no']) ?$old['block_no']: '';?>"/>
                                
                        <label for="name">GST Number</label>
                        <input  type="text" 
                                name="gst_no" 
                                id="gst_no" 
                                class="form-control <?= $errors!='' && $errors->has('gst_no') ? 'error' : '';?>"
                                placeholder = "Enter GST Number"
                                value="<?=$old != '' && isset($old['gst_no']) ?$old['gst_no']: '';?>"/>

                        <label for="name">Phone</label>
                        <input  type="text" 
                                name="phone_no" 
                                id="phone_no" 
                                class="form-control <?= $errors!='' && $errors->has('phone_no') ? 'error' : '';?>"
                                placeholder = "Enter Phone Number"
                                value="<?=$old != '' && isset($old['phone_no']) ?$old['phone_no']: '';?>"/>

                                <label for="name">Email</label>
                        <input  type="email" 
                                name="email_id" 
                                id="email_id" 
                                class="form-control <?= $errors!='' && $errors->has('email_id') ? 'error' : '';?>"
                                placeholder = "Enter Email ID"
                                value="<?=$old != '' && isset($old['email_id']) ?$old['email_id']: '';?>"/>

                        
                                
                        <?php
                          if($errors!="" && $errors->has('first_name'))
                          {
                            echo "<span class='error'>{$errors->first('first_name')}</span>";
                          }
                          if($errors!="" && $errors->has('last_name'))
                          {
                            echo "<span class='error'>{$errors->first('last_name')}</span>";
                          }
                          if($errors!="" && $errors->has('gst_no'))
                          {
                            echo "<span class='error'>{$errors->first('gst_no')}</span>";
                          }
                          if($errors!="" && $errors->has('street'))
                          {
                            echo "<span class='error'>{$errors->first('street')}</span>";
                          }
                          if($errors!="" && $errors->has('city'))
                          {
                            echo "<span class='error'>{$errors->first('city')}</span>";
                          }
                          if($errors!="" && $errors->has('pincode'))
                          {
                            echo "<span class='error'>{$errors->first('pincode')}</span>";
                          }
                          if($errors!="" && $errors->has('state'))
                          {
                            echo "<span class='error'>{$errors->first('state')}</span>";
                          }
                          if($errors!="" && $errors->has('country'))
                          {
                            echo "<span class='error'>{$errors->first('conutry')}</span>";
                          }
                          if($errors!="" && $errors->has('town'))
                          {
                            echo "<span class='error'>{$errors->first('town')}</span>";
                          }
                          if($errors!="" && $errors->has('block_no'))
                          {
                            echo "<span class='error'>{$errors->first('block_no')}</span>";
                          }
                          if($errors!="" && $errors->has('phone_no'))
                          {
                            echo "<span class='error'>{$errors->first('phone_no')}</span>";
                          }
                          if($errors!="" && $errors->has('email_id'))
                          {
                            echo "<span class='error'>{$errors->first('email_id')}</span>";
                          }
                          
                        ?>
                      </div>
                      <!--/FORM GROUP-->
                      <button type="submit" class="btn btn-primary" name="add_supplier" value="addSupplier"><i class="fa fa-check"></i> Submit</button>
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
  <?php require_once(__DIR__ . "/../includes/page-level/customer/add-customer-scripts.php");?>
</body>

</html>