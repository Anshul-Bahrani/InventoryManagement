<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Easy ERP</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?=$sidebarSection== 'dashboard'?'active':'';?>">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?=$sidebarSection== 'category'?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
          <i class="fas fa-fw fa-cog"></i>
          <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse <?=$sidebarSection== 'category'?'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$sidebarSubSection== 'manage'?'active':'';?>" href="<?=BASEPAGES;?>manage-category.php">Manage Category</a>
            <a class="collapse-item <?=$sidebarSubSection== 'add'?'active':'';?>" href="<?=BASEPAGES;?>add-category.php">Add Category</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?=$sidebarSection== 'customer'?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
          <i class="fas fa-fw fa-cog"></i>
          <span>Customer</span>
        </a>
        <div id="collapseCustomer" class="collapse <?=$sidebarSection== 'customer'?'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$sidebarSubSection== 'manage-customer'?'active':'';?>" href="<?=BASEPAGES;?>manage-customer.php">Manage Customer</a>
            <a class="collapse-item <?=$sidebarSubSection== 'add-customer'?'active':'';?>" href="<?=BASEPAGES;?>add-customer.php">Add Customer</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?=$sidebarSection== 'employee'?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
          <i class="fas fa-fw fa-cog"></i>
          <span>Employee</span>
        </a>
        <div id="collapseEmployee" class="collapse <?=$sidebarSection== 'employee'?'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$sidebarSubSection== 'manage-employee'?'active':'';?>" href="#">Manage Employee</a>
            <a class="collapse-item <?=$sidebarSubSection== 'add-employee'?'active':'';?>" href="<?=BASEPAGES;?>add-employee.php">Add Employee</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?=$sidebarSection== 'product'?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
          <i class="fas fa-fw fa-cog"></i>
          <span>Product</span>
        </a>
        <div id="collapseProduct" class="collapse <?=$sidebarSection== 'product'?'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$sidebarSubSection== 'manage-product'?'active':'';?>" href="<?=BASEPAGES;?>manage-product.php">Manage Product</a>
            <a class="collapse-item <?=$sidebarSubSection== 'add-product'?'active':'';?>" href="<?=BASEPAGES;?>add-product.php">Add Product</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?=$sidebarSection== 'supplier'?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier" aria-expanded="true" aria-controls="collapseSupplier">
          <i class="fas fa-fw fa-cog"></i>
          <span>Supplier</span>
        </a>
        <div id="collapseSupplier" class="collapse <?=$sidebarSection== 'supplier'?'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$sidebarSubSection== 'manage-supplier'?'active':'';?>" href="#">Manage Supplier</a>
            <a class="collapse-item <?=$sidebarSubSection== 'add-supplier'?'active':'';?>" href="<?=BASEPAGES;?>add-supplier.php">Add Supplier</a>
          </div>
        </div>
      </li>


      <li class="nav-item <?=$sidebarSection== 'transaction'?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaction" aria-expanded="true" aria-controls="collapseTransaction">
          <i class="fas fa-fw fa-cog"></i>
          <span>Transaction</span>
        </a>
        <div id="collapseTransaction" class="collapse <?=$sidebarSection== 'transaction'?'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$sidebarSubSection== 'Sales'?'active':'';?>" href="<?=BASEPAGES;?>add-sales.php">Sales</a>
            <a class="collapse-item <?=$sidebarSubSection== 'purchase'?'active':'';?>" href="<?=BASEPAGES;?>add-purchase.php">Purchase</a>
            <a class="collapse-item <?=$sidebarSubSection== 'Sales'?'active':'';?>" href="<?=BASEPAGES;?>all-invoices.php">Invoices</a>
          </div>
        </div>
      </li>


      
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Reports</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Sales Report</a>
            <a class="collapse-item" href="#">P &amp; L statements </a>
            <a class="collapse-item" href="#">Purchase History</a>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>